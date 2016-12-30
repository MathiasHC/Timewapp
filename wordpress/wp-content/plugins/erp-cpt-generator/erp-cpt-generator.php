<?php

/**
 * Plugin Name:       ERP Custom Post Type Generator
 * Description:       A plugin for the gallery custom post type
 * Version:           1.0.0
 * Author:            Emil Rosenius Pedersen
 * License:           GNU General Public License v2 or later
 */
class ERP_CPT_Generator {

	/**
	 * ERP_CPT_Generator constructor.
	 */
	public function __construct() {
		$this->require_dependencies();
		$this->run();
	}

	/**
	 * Requires dependencies
	 */
	protected function require_dependencies() {

		/**
		 * The factory for generating custom post types
		 */
		require_once( 'erp-cpt-generator-factory.php' );

		/**
		 * The factory for generating custom taxonomies
		 */
		require_once( 'erp-cpt-generator-taxonomies.php' );

	}

	/**
	 * Setting up the custom post types and taxonomies.
	 */
	protected function run() {
		$this->register_custom_taxonomies();
		$this->register_custom_post_types();
	}

	/**
	 *  Registers post types
	 */
	protected function register_custom_post_types() {
		// new ERP_CPT_Generator_Factory( 'produkter', 'Product', 'Products', 'dashicons-hammer', array( 'title', 'editor' ) );
		new ERP_CPT_Generator_Factory( 'projects', 'Project', 'Projects', 'dashicons-portfolio', array( 'title', 'editor' ) );
		new ERP_CPT_Generator_Factory( 'clients', 'Client', 'Clients', 'dashicons-businessman', array( 'title', 'editor', 'thumbnail' ) );
		new ERP_CPT_Generator_Factory( 'time-registrations', 'Time Registration', 'Time Registrations', 'dashicons-clock', array( 'title', 'editor') );
	}

	/**
	 * Registers taxonomies
	 */
	protected function register_custom_taxonomies() {
		// new ERP_CPT_Generator_Taxonomies( 'case-category', 'Kategori', 'Kategorier', 'case' );
	}

}

/**
 * Instantiate the plugin
 */
new ERP_CPT_Generator();
