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
  wp_dequeue_style('bootstrap-theme-style');
  wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
  wp_dequeue_style('main-style');

  wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
  wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
  wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());

}
