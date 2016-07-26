<?php
/*
Plugin Name: ABillS-Wordpress Plugin
Plugin URI: http://abills.net.ua/
Description: A plugin for ABillS integration
Version: 0.1
Author: ABillS
Author URI: http://abills.net.ua/
Text Domain: abillstextdomain
License: GPLv2

Copyright 2016 ABillS

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


include 'widgets/phones.php';
include 'widgets/link-btn.php';
include 'widgets/abills_stats.php';
include 'widgets/registration.php';
include 'cards.php';


define('ABILLS_CUSTOM_THEME_OPTION', 'abills_bootswitch_theme');
define('ABILLS_COA_WORK_DAYS', 'abills_coa_work_days');
define('ABILLS_COA_WORK_HOURS', 'abills_coa_work_hours');
define('ABILLS_COA_HOLIDAY_DAYS', 'abills_coa_holiday_days');
define('ABILLS_COA_HOLIDAY_HOURS', 'abills_coa_holiday_hours');
define('ABILLS_COA_ADDRESS', 'abills_coa_address');
define('ABILLS_PROVIDER_MAIL', 'abills_provider_mail');
define('ABILLS_BILLING_URL', 'abills_billing_url');
define('ABILLS_GALLERY_IMAGES', 'abills_gallery_images');
define('ABILLS_SLIDESHOW_ON', 'abills_slideshow_on');
define('ABILLS_API_KEY', 'abills_api_key');
define('ABILLS_IMPORT_TARIFFS', 'abills_import_tariffs');

/**
 * Function for baner
 */
function abills_gallery() {
  $abills_billing_url = abills_get_custom_option('abills_billing_url');
  $abills_gallery_images = abills_get_custom_option('abills_gallery_images');

  $abills_slideshow_on = abills_get_custom_option('abills_slideshow_on');
#TODO
  if(empty($abills_slideshow_on)){
    return 1;
  }
  $dir_name = "/images/wordpress/";
  $images_links = $abills_billing_url . $dir_name;

  if (!empty($abills_gallery_images)) {

    $img_names = json_decode($abills_gallery_images, true);

    $carousel_code = '';
    $elements_count = 1;
    $li_elements = '';
    $items_elements = '';

    foreach ($img_names as &$image) {
      $active = '';

      $link = $image['url'];
      $name = $image['name'];
      $describe = $image['describe'];

      if ($elements_count == 1) {
        $active = 'active';
      }
      $li_elements .= "<li data-target='#myCarousel' data-slide-to='$elements_count' class='$active'></li>";
      $items_elements .= "<div class='item $active'><img  src='$images_links$name'>
      <div class='carousel-caption'>
      <p><a class='btn btn-primary' href=$link >$describe</a></p>
      </div>
      </div>";
      $elements_count++;
    }
    echo "<div class='col-md-12'>
    <div id='myCarousel' class='carousel slide' data-ride='carousel'>
    <!-- Indicators -->
    <ol class='carousel-indicators'>"
      . $li_elements
      . "</ol>"
      . "<div class='carousel-inner' role='listbox'>"
      . $items_elements
      . "</div>"
      . "<a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
       <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
       <span class='sr-only'>Previous</span>
       </a>
       <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
       <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
       <span class='sr-only'>Next</span>
       </a>
       </div>
       </div>";

  } else {
    return 1;
  }
}

/**
 *  Check if custom theme should be loaded and load it
 */
function abills_load_custom_theme() {
  $theme = get_option(ABILLS_CUSTOM_THEME_OPTION, false);

  if (!$theme) {
    add_option(ABILLS_CUSTOM_THEME_OPTION, '');
  }

  if (!empty($theme)) {
    wp_dequeue_style('bootstrap-style');
    wp_dequeue_style('bootstrap-basic-style');
    wp_dequeue_style('bootstrap-style-css');
    wp_enqueue_style('bootswitch-theme', "/wp-content/plugins/abills/css/colors/$theme.css");
    wp_enqueue_style('abills-cards', "/wp-content/plugins/abills/css/cards.css");
  }

  return 1;
}

/**
 * Saves new values for custom options
 *
 * @param $args
 *
 * @return bool
 * @internal param $options
 */
function abills_update_custom_options($args) {
  global $wp_xmlrpc_server;

  # Preserving options from escape
  $new_options = $args[3];

  # Escape auth options
  $wp_xmlrpc_server->escape($args);
  $blog_id = $args[0];
  $username = $args[1];
  $password = $args[2];

  if (!$user = $wp_xmlrpc_server->login($username, $password))
    return $wp_xmlrpc_server->error;


  foreach ($new_options as $option_name => $new_value) {
    update_option($option_name, utf8_decode($new_value));
  }

  return $new_options;
}

/**
 *  List of installed Bootswitch themes
 *
 * @return array
 */
function abills_get_custom_themes() {
  $colors_folder = plugin_dir_path(__FILE__) . "css/colors";
  $themes = array_diff(scandir($colors_folder), array('..', '.'));
  $names = array();

  foreach ($themes as &$name) {
    array_push($names, basename($name, '.css'));
  };

  return $names;
}

/**
 *
 * Current applied color theme
 * @return string
 */
function abills_get_current_theme() {
  return get_option(ABILLS_CUSTOM_THEME_OPTION, '');
}

/**
 *
 * @param $option_name
 * @return string
 */
function abills_get_custom_option($option_name) {

  return get_option($option_name, '');
}

/**
 *
 * @return array
 */
function abills_get_custom_options() {
  $ABILLS_CUSTOM_OPTIONS = array(
    'abills_has_coa',
    'abills_bootswitch_theme',
    'abills_coa_work_days',
    'abills_coa_work_hours',
    'abills_coa_holiday_days',
    'abills_coa_holiday_hours',
    'abills_coa_address',
    'abills_provider_mail',
    'abills_billing_url',
    'abills_gallery_images',
    'abills_api_key',
    'abills_slideshow_on',
  );

  $result = array();
  foreach ($ABILLS_CUSTOM_OPTIONS as &$option_name) {
    $result{$option_name} = get_option($option_name, '');
  }

  return $result;
}

/**
 *
 * @param $args
 * @return array
 */
function abills_set_custom_options($args) {
  $ABILLS_CUSTOM_OPTIONS = array(
    'abills_has_coa',
    'abills_bootswitch_theme',
    'abills_coa_work_days',
    'abills_coa_work_hours',
    'abills_coa_holiday_days',
    'abills_coa_holiday_hours',
    'abills_coa_address',
    'abills_provider_mail',
    'abills_billing_url',
    'abills_gallery_images',
    'abills_api_key',
    'abills_slideshow_on',
  );

  $result = array();
  foreach ($ABILLS_CUSTOM_OPTIONS as &$option_name) {
    $current_value = get_option($option_name);
    if (!$current_value) {
      add_option($option_name, $args{$option_name});
    } else {
      update_option($option_name, $args{$option_name});
    }
  }

  return $result;
}

/**
 * Extend XML-RPC API
 *
 * @param $methods - Wordpress base methods
 *
 * @return mixed - modified methods
 */
function abills_new_xmlrpc_methods($methods) {

  $methods['abills.get_custom_themes'] = 'abills_get_custom_themes';
  $methods['abills.update_custom_options'] = 'abills_update_custom_options';
  $methods['abills.get_current_theme'] = 'abills_get_current_theme';
  $methods['abills.get_custom_options'] = 'abills_get_custom_options';
  $methods['abills.set_custom_options'] = 'abills_set_custom_options';

  return $methods;
}

/* Register the widgets */
add_action('widgets_init', function () {
  register_widget('Phones_Widget');
  register_widget('Link_button_widget');
  register_widget('Abills_stats_widget');
  register_widget('Abills_registration_widget');
});

/* Modify head */
add_action('wp_head', function () {

  // Custom Bootswitch theme
  abills_load_custom_theme();

  // Plugin uses some CSS to make things shiny
  wp_enqueue_style('abills-styles', '/wp-content/plugins/abills/css/abills.css');

  // Custom JS
  wp_enqueue_script('abills-mustache', '/wp-content/plugins/abills/js/vendor/mustache.min.js');
  wp_enqueue_script('abills-script', '/wp-content/plugins/abills/js/abills.js');

});

/* Extending XML-RPC methods */
add_filter('xmlrpc_methods', 'abills_new_xmlrpc_methods');

?>