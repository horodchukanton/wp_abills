<?php

add_action( 'wp_enqueue_scripts', 'bootstrap_basic_parent_theme_enqueue_styles' );

function bootstrap_basic_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-basic-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'abills-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap-basic-style' )
    );

}
