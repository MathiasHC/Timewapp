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

// This is a temporary solution until register_post_type_args is available
// After adding your CPT, you can find it at mysite.com/wp-json/wp/v2/[slug]
function sb_add_cpts_to_api() {
	global $wp_post_types;

	// Add CPT slugs here
	$arr = ['projects','clients','time-registrations'];

	foreach( $arr as $key ) {

		// If the post type doesn't exist, skip it
		if( !$wp_post_types[$key] )
			var_dump('<h1>' . $key . ' findes ikke</h1>');
			continue;

		$wp_post_types[$key]->show_in_rest = true;
		$wp_post_types[$key]->rest_base = $key;
		$wp_post_types[$key]->rest_controller_class = 'WP_REST_Posts_Controller';
	}
}
add_action( 'init', 'sb_add_cpts_to_api', 30 );

