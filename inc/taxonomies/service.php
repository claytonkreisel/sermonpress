<?php
	
	//The Service Taxonomy
	
	add_action( 'init', 'create_service_taxonomy', 0 );
	
	function create_service_taxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Services', 'taxonomy general name' ),
			'singular_name'     => _x( 'Service', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Services' ),
			'all_items'         => __( 'All Services' ),
			'parent_item'       => __( 'Parent Service' ),
			'parent_item_colon' => __( 'Parent Service:' ),
			'edit_item'         => __( 'Edit Service' ),
			'update_item'       => __( 'Update Service' ),
			'add_new_item'      => __( 'Add New Service' ),
			'new_item_name'     => __( 'New Service Name' ),
			'menu_name'         => __( 'Services' ),
		);
		$labels = apply_filters('sermonpress_service_labels', $labels);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'has_archive'		=> true,
			'public'			=> true,
			'publicly_queryable' => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sermons/services', 'with_front' => false ),
		);
	
		register_taxonomy( 'service', array( 'sermon' ), $args );
	}
?>