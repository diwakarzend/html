<?php
//* Code goes here

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles',20);

function enqueue_parent_styles() {
    wp_register_style( 'parent-style', get_template_directory_uri().'/style.css' ,array(), rand(112,9998), 'all' );
    wp_enqueue_style( 'parent-style' ,array(), rand(112,9998), 'all');
    
   }
?>
