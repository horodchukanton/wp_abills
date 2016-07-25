/**
 * Created by Anykey on 22.07.2016.
 */


var options = {
    language: 'Russian'
};


var $wrapper = jQuery('.abills-stats-wrapper');

var abills_params = abills_params || window['abills_params'];
var sid = abills_params.sid;
var billing_url = abills_params.uri;

var FILTER_FN = {
    'NONE': function (raw_html) {
        return raw_html
    },
    'HIDDEN': function () {
        return ''
    },
    'HIDDEN_IF_EMPTY': function (raw_html, value) {
        if (value === '') return '';
        return raw_html;
    },
    'HIGHLIGHT': function (raw_html) {
        return $(raw_html).addClass('success').outerHTML()
    },
    'CRITICAL': function (raw_html) {
        return $(raw_html).addClass('danger').outerHTML()
    },
    'SIGNED': function (raw_html, value) {
        var class_ = (value < 0) ? 'danger' : 'success';
        return $(raw_html).addClass(class_).outerHTML()
    }
};

if (sid) {
  getUserInfo(sid);
}

function getUserInfo(sid) {
    var params = {
        sid: sid,
        language: 'russian',
        xml: 1
    };

    console.log('billing uri', billing_url);

    jQuery.get(billing_url, params, function(data){
        if (!parse_first_page(data)){
            var form = jQuery('#abills_stats_login_form');
            form.removeClass('hidden');
        }
    }).fail(function () {
        console.warn('FAILED TO LOAD XML FROM ABILLS');
        // TODO: Notify billing
    }).always(
        function(){
            jQuery('.abills-stats-wrapper').remove();
        }
    );
}


/**
 * _ (translate)
 * @param lang_variable
 * @returns translated string
 */
function _(lang_variable) {
    // Default to English as defined in "xml_explain.js"
    return languages[options.language][lang_variable] || lang_variable;
}

function parse_first_page(data) {
    //var page_data = serializer.parse(data);
    var page_data = jQuery(data);

    if (page_data.find('INFO[name="form_client_login"]').length > 0){
        console.warn('unauthorized');
        return false;
    }

    // On the first page we can see all client information stuff
    var new_data = renew_client_data(page_data);

    // Renew HTML representation
    fill_client_information_page(new_data);
    console.log(new_data);
    return true;
}


function renew_client_data(page_data) {
    // Localizing global variable
    var xml_mappings = document['xml_mappings'];

    function retrieveValueFor(key) {

        function getTextFor(name) {
            return page_data.find(name).first().text();
        }

        var xml_name = xml_mappings[key];
        var value = '';

        //Check if value contains of few fields
        if (xml_name.indexOf('|') != -1) {
            jQuery.each(xml_name.split('|'), function (i, name) {
                value += getTextFor(name) + ' ';
            });
        }
        else {
            value = getTextFor(xml_name);
        }
        return value;
    }

    var client_data = {};
    for (var key in xml_mappings) {
        if (!xml_mappings.hasOwnProperty(key)) continue;
        client_data[key] = retrieveValueFor(key);
    }

    return client_data;

}


function fill_client_information_page(client_data) {

    delete client_data['User ID'];
    delete client_data['E-Mail'];
    delete client_data['Server time'];
    delete client_data['IP'];
    delete client_data['Contract'];
    delete client_data['Message'];

    // TODO: simply delete redundant keys as optimization
    // TODO: Make hidden input with boolean for state
    var default_filters = {
        'Cash': 'SIGNED',
        'Credit': function (raw_html, value) {
            if (value <= 0) {
                return '';
            }
            return '<tr><td>' + _('Credit') + '</td>'
                + '<td>' + value + ' ' + _('till') + ' ' + client_data['Credit expire'] + '</td>' +
                '</tr>'
        },
        'Reduction': function (raw_html, value) {
            if (value <= 0) {
                return '';
            }
            return '<tr><td>' + _('Reduction') + '</td>'
                + '<td>' + value + '% ' + _('till') + ' ' + client_data['Reduction date'] + '</td>' +
                '</tr>'
        },
        'Credit expire': 'HIDDEN',
        'Reduction date': 'HIDDEN',
        'Expire date': 'HIDDEN_IF_EMPTY'
    };

    $wrapper.parent().find('.panel-body').after(data_object_to_table(client_data, default_filters));
    $wrapper.parent().find('.fa-spin').remove();
    $wrapper.parent().find('.panel-body').remove();
    $wrapper.parent().find('.panel-footer').find('button').remove();
    $wrapper.parent().find('.panel-footer').html('<a href="'+ billing_url + '?' + 'sid=' + sid + '" class="btn btn-success form-control">Войти</a>');
}

function data_object_to_table(data_object, filters) {
    if (!filters) filters = {};

    var table = '<table class="table table-striped table-condensed table-bordered"><tbody>';

    for (var data_key in data_object) {
        if (!data_object.hasOwnProperty(data_key)) continue;

        var tr = '<tr>';
        tr += '<td>' + _(data_key) + '</td>';
        tr += '<td>' + data_object[data_key] + '</td>';
        tr += '</tr>';

        if (filters[data_key]) {
            tr = apply_filter(tr, filters[data_key], data_object[data_key]);
        }
        else {
            if (!data_object[data_key]){
                tr = '';
            }
        }

        table += tr;
    }

    table += '</tbody></table>';
    return table;

    function apply_filter(raw_html, filter, value) {
        if (typeof filter === 'function') {
            return filter(raw_html, value);
        }
        else {
            if (FILTER_FN[filter]) {
                return FILTER_FN[filter](raw_html, value);
            }
        }
        console.log('filter not applied');
        return raw_html;
    }
}

