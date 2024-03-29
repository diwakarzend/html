<?php
//* Code goes here

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ), rand(101,9999), 'all');
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css');
}

function my_custom_scriptss() {
  wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ), rand(101,9999),true);
}
add_action( 'wp_enqueue_scripts', 'my_custom_scriptss' );

function ssl_srcset( $sources ) {
  foreach ( $sources as &$source ) {
    $source['url'] = set_url_scheme( $source['url'], 'https' );
  }

  return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );

?>
