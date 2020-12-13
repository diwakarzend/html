<?php
//* Code goes here

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ), rand(101,9999), 'all');
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css');
}

function my_custom_scripts() {
  wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ),rand(101,9999),true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );
?>