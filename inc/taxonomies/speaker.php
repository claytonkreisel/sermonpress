<?php
	
	//The Speaker Taxonomy
	
	add_action( 'init', 'create_speaker_taxonomy', 0 );
	
	function create_speaker_taxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Speakers', 'taxonomy general name' ),
			'singular_name'     => _x( 'Speaker', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Speakers' ),
			'all_items'         => __( 'All Speakers' ),
			'parent_item'       => __( 'Parent Speaker' ),
			'parent_item_colon' => __( 'Parent Speaker:' ),
			'edit_item'         => __( 'Edit Speaker' ),
			'update_item'       => __( 'Update Speaker' ),
			'add_new_item'      => __( 'Add New Speaker' ),
			'new_item_name'     => __( 'New Speaker Name' ),
			'menu_name'         => __( 'Speakers' ),
		);
		$labels = apply_filters('sermonpress_speaker_labels', $labels);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'has_archive'		=> true,
			'public'			=> true,
			'publicly_queryable' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sermons/speakers', 'with_front' => false ),
		);
	
		register_taxonomy( 'speaker', array( 'sermon' ), $args );
		
		//Custom Taxonomy Fields
		add_filter('rwmb_meta_boxes', 'add_speaker_term_fields');
		function add_speaker_term_fields($meta_boxes){
			$speaker_types = array(
				'pastor' => 'Pastor/Elder',
				'member' => 'Member',
				'guest' => 'Guest'
			);
			$speaker_types = apply_filters('trsl_speaker_types', $speaker_types);
			$meta_boxes[] = array(
				'id' => 'speaker_info_box',
				'title' => __('Speaker Box Info', 'sermonpress'),
				'taxonomies' => 'speaker',
				'fields' => array(
					array(
						'id' => 'speaker_pic',
						'name' => __('Picture', 'sermonpress'),
						'type' => 'image_advanced',
						'desc' => __('This picture will be used for the speakers profile picture.', 'sermonpress')
					),
					array(
						'id' => 'speaker_type',
						'name' => __('Speaker Type', 'sermonpress'),
						'type' => 'select_advanced',
						'desc' => __('The type of speaker this person is.', 'sermonpress'),
						'options' => $speaker_types
					)
				)
			);
			return $meta_boxes;
		}
	}
?>