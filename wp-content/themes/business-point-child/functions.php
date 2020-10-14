<?php
//* Code goes here

// add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles');

// function enqueue_parent_styles() {
//    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' ,array(), rand(112,9998), 'all' );
//    // wp_enqueue_style( 'parent-style' ,array(), rand(112,9998), 'all');
    
//    }

   add_action( 'wp_enqueue_scripts', function() {

	if ( ! defined( 'parent-style' ) ) {
		return;
	}

	// First de-register the main child theme stylesheet
	wp_deregister_style( 'parent-style' );

	// Then add it again, using filemtime for the version number so everytime the child theme changes so will the version number
	wp_register_style( 'parent-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

	// Finally enqueue it again
	wp_enqueue_style( 'parent-style' );
} );
?>
