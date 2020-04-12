<?php

	//The Series Taxonomy

	add_action( 'init', 'create_series_taxonomy', 0 );

	function create_series_taxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Series', 'taxonomy general name' ),
			'singular_name'     => _x( 'Series', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Series' ),
			'all_items'         => __( 'All Series' ),
			'parent_item'       => __( 'Parent Series' ),
			'parent_item_colon' => __( 'Parent Series:' ),
			'edit_item'         => __( 'Edit Series' ),
			'update_item'       => __( 'Update Series' ),
			'add_new_item'      => __( 'Add New Series' ),
			'new_item_name'     => __( 'New Series Name' ),
			'menu_name'         => __( 'Series' ),
		);
		$labels = apply_filters('sermonpress_series_labels', $labels);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'has_archive'		=> true,
			'public'			=> true,
			'publicly_queryable' => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sermons/series', 'with_front' => false ),
		);

		register_taxonomy( 'series', array( 'sermon' ), $args );
	}

	//Custom Taxonomy Fields
	add_filter('rwmb_meta_boxes', 'add_series_term_fields');
	function add_series_term_fields($meta_boxes){
		$meta_boxes[] = array(
			'id' => 'series_info_box',
			'title' => 'Series Box Info',
			'taxonomies' => 'series',
			'fields' => array(
				array(
					'id' => 'series_banner',
					'name' => 'Image Banner',
					'type' => 'image_advanced',
					'desc' => 'The banner that will be associated with the series.'
				)
			)
		);
		return $meta_boxes;
	}
?>
