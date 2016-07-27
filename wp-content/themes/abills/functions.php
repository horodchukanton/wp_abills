<?php

add_action( 'wp_enqueue_scripts', 'bootstrap_basic_parent_theme_enqueue_styles' );

function bootstrapBasicEnqueueScripts(){

}

function bootstrap_basic_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-basic-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'abills-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap-basic-style' )
    );

  global $wp_scripts;

  wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
//  wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
  wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

  wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
  wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
  $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
  wp_enqueue_script('respond-script');
  wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
  $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
  wp_enqueue_script('html5-shiv-script');
  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
  wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
//  wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());

}
