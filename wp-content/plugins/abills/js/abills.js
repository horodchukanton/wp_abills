/**
 * Created by Anykey on 16.07.2016.
 */

// Restoring jQuery
var $ = jQuery;

var phonesWidgets = [];

var $contacts_row = $('#abills-contacts_row');

function ContactsRow(id) {
    var self = this;
    var $self = $('#' + id);

    var $self_btn = $self.find('a');

    this.opened = false;
    this.id = id;

    $self.hover(
        function () {
          $self_btn.removeClass('btn-info');
          $self_btn.addClass('btn-primary');
        },
        function () {
          $self_btn.removeClass('btn-primary');
          $self_btn.addClass('btn-info');
        }
    );

    $self.on('click', function () {
        (!self.opened) ? self.showContacts() : self.hideContacts();
    });

    this.showContacts = function () {
        self.opened = true;
        $contacts_row.animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow")
    };

    this.hideContacts = function () {
        self.opened = false;
        $contacts_row.animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow")
    };

}

$(function () {

    $('.Abills_button_widget>a').css({'max-height' : $('.phones_widget').css('height')});

    $.each($('.phones_widget'), function (i, e) {
        phonesWidgets.push(new ContactsRow(e.id));
    });


    $("form#request_call_form").on("submit", function (event) {
        event.preventDefault();

        $('#request_call_btn').addClass('disabled');

        var phone = $("input#phone").val();

        $.post('/abills/request_call.php', {phone: phone})
            .done(function (data) {
                console.log(data);
                if (data === 'success') {
                    var message = '<div class="alert alert-success" role="alert">' +
                        '<b>Спасибо!</b> Ваша заявка принята.<br>' +
                        'Пожалуйста, ожидайте звонка.' +
                        '</div>';
                    $('#request_call_wrapper').html(message);
                }
            })
            .fail(
                function () {
                    console.log('fail');
                }
            );
    });

    jQuery('.card-more-btn').on('click', function () {
        var $this = jQuery(this);
        $this.parent().parent().find('.card-reveal').slideToggle('slow');
    });

    jQuery('.card-reveal .close').on('click', function () {
        var $this = jQuery(this);
        $this.closest('.card-reveal').slideToggle('slow');
    });


    //Init popovers
    $('[data-toggle="popover"]').popover();

    //If adminrow showed need to add additional padding to top
    if ($('#wpadminbar').length > 0) {
        var height = $('#wpadminbar').css('height');
        // $('body').css({'padding-top' : height});
        $('.navbar.navbar-fixed-top').css({top: height});
    }


});
