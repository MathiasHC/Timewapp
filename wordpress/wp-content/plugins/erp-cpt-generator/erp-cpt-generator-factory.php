<?php

/**
 * Class ERP_CPT_Generator_Factory
 */
class ERP_CPT_Generator_Factory {

	/**
	 * @var string      The slug for the post type
	 */
	private $slug;

	/**
	 * @var string      The singular name for the post type
	 */
	private $singular;

	/**
	 * @var string      The plural name for the post type
	 */
	private $plural;

	/**
	 * @var string      The icon used in the admin menu
	 */
	private $icon;

	/**
	 * @var array       The supports for the custom post type
	 */
	private $supports;

	/**
	 * ERP_CPT_Generator_Factory constructor.
	 *
	 * @param $slug string          The slug for the post type
	 * @param $singular string      The singular name for the post type
	 * @param $plural string        The plural name for the post type
	 * @param $icon string          The icon used in the admin menu
	 * @param $supports array       The supports for the custom post type
	 */
	public function __construct( $slug, $singular, $plural, $icon, $supports = array( 'title', 'editor' ) ) {
		$this->slug     = $slug;
		$this->singular = $singular;
		$this->plural   = $plural;
		$this->icon     = $icon;
		$this->supports = $supports;
		$this->define_hooks();
	}

	/**
	 * Defines basic hooks called in the constructor
	 */
	private function define_hooks() {
		add_action( 'init', array( $this, 'register_custom_post_type' ), 0 );
	}

	/**
	 * Adds the custom post type
	 */
	public function register_custom_post_type() {

		$labels = array(
			'name'                  => _x( $this->plural, 'Post Type General Name', 'erp_cpt_generator' ),
			'singular_name'         => _x( $this->singular, 'Post Type Singular Name', 'erp_cpt_generator' ),
			'menu_name'             => __( $this->plural, 'erp_cpt_generator' ),
			'name_admin_bar'        => __( $this->plural, 'erp_cpt_generator' ),
			'parent_item_colon'     => __( 'Forældre ' . $this->singular, 'erp_cpt_generator' ),
			'all_items'             => __( 'Alle ' . $this->plural, 'erp_cpt_generator' ),
			'add_new_item'          => __( 'Tilføj ' . $this->singular, 'erp_cpt_generator' ),
			'add_new'               => __( 'Tilføj nyt ' . $this->singular, 'erp_cpt_generator' ),
			'new_item'              => __( 'Tilføj ' . $this->singular, 'erp_cpt_generator' ),
			'edit_item'             => __( 'Rediger ' . $this->singular, 'erp_cpt_generator' ),
			'update_item'           => __( 'Opdater ' . $this->singular, 'erp_cpt_generator' ),
			'view_item'             => __( 'Se ' . $this->singular, 'erp_cpt_generator' ),
			'search_items'          => __( 'Søg i ' . $this->plural, 'erp_cpt_generator' ),
			'not_found'             => __( 'Ingen ' . $this->plural . ' fundet', 'erp_cpt_generator' ),
			'not_found_in_trash'    => __( 'Ingen ' . $this->plural . ' fundet i papirkurven', 'erp_cpt_generator' ),
			'items_list'            => __( $this->singular . ' liste', 'erp_cpt_generator' ),
			'items_list_navigation' => __( $this->singular . ' navigation', 'erp_cpt_generator' ),
			'filter_items_list'     => __( 'Filtrer ' . $this->plural, 'erp_cpt_generator' ),
		);
		$args   = array(
			'label'               => __( $this->singular, 'erp_cpt_generator' ),
			'description'         => __( 'Tilføj og rediger i ' . $this->plural, 'erp_cpt_generator' ),
			'labels'              => $labels,
			'supports'            => $this->supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_position'       => 5,
			'menu_icon'           => $this->icon,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( $this->slug, $args );
	}

}
