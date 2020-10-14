<?php
//* Code goes here

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles() {
  // wp_enqueue_style( 'child-style', get_stylesheet_uri().'/style.css' ,array(), rand(112,9998), 'all' );
   // wp_enqueue_style( 'parent-style' ,array(), rand(112,9998), 'all');
    
wp_enqueue_style('main-styles', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'), false);
   }

   
?>
