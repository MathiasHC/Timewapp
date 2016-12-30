<?php

/**
 * Class ERP_CPT_Generator_Taxonomies
 */
class ERP_CPT_Generator_Taxonomies {

	/**
	 * @var string      The slug for the custom taxonomy
	 */
	private $slug;

	/**
	 * @var string      The singular name for the custom taxonomy
	 */
	private $singular;

	/**
	 * @var string      The plural name for the custom taxonomy
	 */
	private $plural;

	/**
	 * @var string      The custom post type for the custom taxonomy
	 */
	private $cpt;

	/**
	 * ERP_CPT_Generator_Taxonomies constructor.
	 *
	 * @param $slug string          The slug for the custom taxonomy
	 * @param $singular string      The singular name for the custom taxonomy
	 * @param $plural string        The plural name for the custom taxonomy
	 * @param $cpt string           The custom post type for the custom taxonomy
	 */
	public function __construct( $slug, $singular, $plural, $cpt ) {
		$this->slug     = $slug;
		$this->singular = $singular;
		$this->plural   = $plural;
		$this->cpt      = $cpt;
		$this->define_hooks();
	}

	/**
	 * Defines basic hooks called in the constructor
	 */
	public function define_hooks() {
		add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
	}

	/**
	 * Adds the custom taxonomy
	 */
	public function register_custom_taxonomy() {
		$labels = array(
			'name'               => __( $this->plural, 'erp_cpt_generator' ),
			'singular_name'      => __( $this->singular, 'erp_cpt_generator' ),
			'add_name'           => __( 'Tilføj Ny', 'erp_cpt_generator' ),
			'add_new_item'       => __( 'Tilføj Ny ' . $this->singular, 'erp_cpt_generator' ),
			'edit'               => __( 'Redigér', 'erp_cpt_generator' ),
			'edit_item'          => __( 'Redigér ' . $this->singular, 'erp_cpt_generator' ),
			'new_item'           => __( 'Ny ' . $this->singular, 'erp_cpt_generator' ),
			'view'               => __( 'Vis ' . $this->singular, 'erp_cpt_generator' ),
			'view_item'          => __( 'Vis ' . $this->singular, 'erp_cpt_generator' ),
			'search_term'        => __( 'Søg i ' . $this->plural, 'erp_cpt_generator' ),
			'parent'             => __( 'Forælder ' . $this->singular, 'erp_cpt_generator' ),
			'not_found'          => __( 'Ingen ' . $this->plural . ' fundet', 'erp_cpt_generator' ),
			'not_found_in_trash' => __( 'Ingen ' . $this->plural . ' fundet i papirkurven', 'erp_cpt_generator' )
		);
		$args   = array(
			'labels'            => $labels,
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'show_in_quck_edit' => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => $this->slug )
		);

		register_taxonomy( $this->slug, $this->cpt, $args );

	}

}
