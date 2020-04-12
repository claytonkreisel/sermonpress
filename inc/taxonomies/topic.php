<?php

	//The Topic Taxonomy

	add_action( 'init', 'create_topic_taxonomy', 0 );

	function create_topic_taxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Topics', 'taxonomy general name' ),
			'singular_name'     => _x( 'Topic', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Topics' ),
			'all_items'         => __( 'All Topics' ),
			'parent_item'       => __( 'Parent Topic' ),
			'parent_item_colon' => __( 'Parent Topic:' ),
			'edit_item'         => __( 'Edit Topic' ),
			'update_item'       => __( 'Update Topic' ),
			'add_new_item'      => __( 'Add New Topic' ),
			'new_item_name'     => __( 'New Topic Name' ),
			'menu_name'         => __( 'Topics' ),
		);
		$labels = apply_filters('sermonpress_topic_labels', $labels);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'has_archive'		=> true,
			'public'			=> true,
			'publicly_queryable' => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sermons/topics', 'with_front' => false ),
		);

		register_taxonomy( 'topic', array( 'sermon' ), $args );
	}
?>
