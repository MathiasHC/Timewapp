<?php

/**
 * Enqueue stylesheet.
 */
add_action( 'wp_enqueue_scripts', 'child_theme_stylesheet' );
function child_theme_stylesheet() {
	// Enqueue our child-theme stylesheet.
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/assets/css/child.css', array(), null, 'all' );
}

/**
 * Remove unwanted admin menu items from WordPress backend.
 */
add_action( 'admin_menu', 'wp_remove_menus');
function wp_remove_menus() {
	remove_menu_page( 'edit-comments.php' );    // Comments.
	remove_menu_page( 'edit.php' );             // Posts (not pages).
}

