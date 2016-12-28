<?php

/**
 * Enqueue stylesheet.
 */
add_action( 'wp_enqueue_scripts', 'child_theme_stylesheet' );
function child_theme_stylesheet() {
	// Enqueue our child-theme stylesheet.
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/assets/css/child.css', array(), null, 'all' );
}


