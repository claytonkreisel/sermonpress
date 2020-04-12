<?php

	//Register Post Type
	function sermonpress_register_sermons(){
		$labels = array(
			'name'               => _x( 'Sermons', 'post type general name', 'faithfamily' ),
			'singular_name'      => _x( 'Sermon', 'post type singular name', 'faithfamily' ),
			'menu_name'          => _x( 'Sermons', 'admin menu', 'faithfamily' ),
			'name_admin_bar'     => _x( 'Sermon', 'add new on admin bar', 'faithfamily' ),
			'add_new'            => _x( 'Add New', 'sermon', 'faithfamily' ),
			'add_new_item'       => __( 'Add New Sermon', 'faithfamily' ),
			'new_item'           => __( 'New Sermon', 'faithfamily' ),
			'edit_item'          => __( 'Edit Sermon', 'faithfamily' ),
			'view_item'          => __( 'View Sermon', 'faithfamily' ),
			'all_items'          => __( 'All Sermons', 'faithfamily' ),
			'search_items'       => __( 'Search Sermons', 'faithfamily' ),
			'parent_item_colon'  => __( 'Parent Sermons:', 'faithfamily' ),
			'not_found'          => __( 'No sermons found.', 'faithfamily' ),
			'not_found_in_trash' => __( 'No sermons found in Trash.', 'faithfamily' ),
		);
		$labels = apply_filters('sermonpress_sermon_labels', $labels);
		$rewrite_slug = apply_filters('sermonpress_sermons_rewrite_slug', 'sermons');
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $rewrite_slug ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 56,
			'menu_icon'			 => 'dashicons-sp-feed',
			'show_in_rest'		 => false,
			'rest_base'          => 'sermon',
  			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports'           => array( 'title', 'editor', 'page-attributes', 'thumbnail' )
		);

		register_post_type( 'sermon', $args );
	}
	add_action('init', 'sermonpress_register_sermons');

	//Register Meta Boxes
	function sermonpress_register_sermons_meta_boxes($meta_boxes){
		global $wpdb;
		$prefix = 'sermon_';

		$sermon_info_fields = array(
			array(
				'name' => 'Featured?',
				'id' => $prefix.'featured',
				'type' => 'select',
				'options' => array('no' => 'No', 'yes' => 'Yes')
			),
			array(
				'name' => 'Date Given',
				'id' => $prefix.'date',
				'type' => 'datetime',
			),
			array(
				'name' => 'Short Description',
				'id' => $prefix.'short_text',
				'type' => 'textarea',
			)
		);
		$app_token = get_sermonpress_setting('sermon_esv_token');
		if($app_token != ''){
			$sermon_info_fields[] = array(
				'name' => 'Sermon Passages (ESV)',
				'id' => $prefix.'passages',
				'type' => 'text',
				'clone' => true,
				'sort_clone' => true,
				'desc' => 'Enter the scripture references of the passages you wish to show for this sermon on the sermon page in the ESV. The best practice is to use the books full name and the address as such: <br/>"1 Corinthians 13:1-4" or "1 Corinthians 13".'
			);
		} else {
			$sermon_info_fields[] = array(
				'name' => 'Sermon Passages (ESV)',
				'id' => $prefix.'passages_no_show',
				'type' => 'custom_html',
				'std' => '<div class="post-field-alert"><p>In order to enable this feature you need to complete the setup <a href="'.sermonpress_get_settings_url('single').'">here</a>. SermonPress > Single > Bible Verse Lookup > ESV Application Token.</p><p>For more info you can look at the documentation <a target="_blank" href="https://www.sermonpress.io/help-center/bible-verse-lookup-setup/">here</a>.</div><p>'
			);
		}
		$sermon_info_fields = apply_filters('sermonpress_sermon_info_fields', $sermon_info_fields, $prefix);

		//Sermons Info Box
		$meta_boxes[] = array(
			'id' => 'sermon_info',
			'title' => 'Sermon Info',
			'pages' => array('sermon'),
			'context' => 'normal',
			'priorty' => 'high',
			'fields' => $sermon_info_fields
		);

		$sermon_media_fields = array(
			array(
				'name' => 'Image',
				'id' => $prefix.'image_heading',
				'type' => 'heading',
			),
			array(
				'name' => 'Sermon Image',
				'id' => $prefix.'image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status' => false,
				'desc' => 'Upload your sermon image file here. This will be displayed on the audio player.'
			),
			array(
				'name' => 'Audio',
				'id' => $prefix.'audio_heading',
				'type' => 'heading',
			),
			array(
				'name' => 'Sermon Audio',
				'id' => $prefix.'audio',
				'type' => 'file_input',
				'desc' => 'Upload your sermon audio file here or enter in a URL link to its external location.'
			),
			array(
				'name' => 'Video',
				'id' => $prefix.'video_heading',
				'type' => 'heading',
			),
			array(
				'name' => 'Sermon Video URL',
				'id' => $prefix.'video',
				'type' => 'url',
				'desc' => 'Copy and paste the video url here for embedding.'
			),
			array(
				'name' => 'Sermon Video Download',
				'id' => $prefix.'video_dl',
				'type' => 'file_input',
				'desc' => 'Upload your sermon video file here or enter in a URL link to its external location.'
			),
		);
		$sermon_media_fields = apply_filters('sermonpress_sermon_media_fields', $sermon_media_fields, $prefix);

		//Sermons Media Box
		$meta_boxes[] = array(
			'id' => 'sermon_media',
			'title' => 'Sermon Media',
			'pages' => array('sermon'),
			'context' => 'normal',
			'priorty' => 'high',
			'fields' => $sermon_media_fields
		);

		$sermon_additional_fields = array(
			array(
				'name' => 'Other Files',
				'id' => $prefix.'files_heading',
				'type' => 'heading',
			),
			array(
				'name' => 'Sermon Attachments',
				'id' => $prefix.'attachments',
				'type' => 'file_advanced',
				'desc' => 'You can place sermon notes, powerpoints, reference documents, pictures, etc. here.'
			),
			array(
				'name' => 'Online Links and Resources',
				'id' => $prefix.'links_heading',
				'type' => 'heading',
			),
			array(
				'name' => 'Sermon Online Resources',
				'id' => $prefix.'links_group',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'fields' => array(
					array(
						'name' => 'Link URL',
						'id' => $prefix.'links_url',
						'type' => 'url',
						'desc' => 'Enter the URL including the http.'
					),
					array(
						'name' => 'Link Text',
						'id' => $prefix.'links_text',
						'type' => 'text',
						'desc' => 'Enter the text you want to use for the URL above.'
					)
				),
				'desc' => 'Copy and paste the urls of links here for embedding.'
			),
		);
		$sermon_additional_fields = apply_filters('sermonpress_sermon_additional_resources_fields', $sermon_additional_fields, $prefix);

		//Sermons Media Box
		$meta_boxes[] = array(
			'id' => 'sermon_media_additional',
			'title' => 'Sermon Additional Resources',
			'pages' => array('sermon'),
			'context' => 'normal',
			'priorty' => 'high',
			'fields' => $sermon_additional_fields
		);

		return $meta_boxes;
	}
	add_filter('rwmb_meta_boxes', 'sermonpress_register_sermons_meta_boxes', 2);

	//Download and Save Passages
	function sermonpress_download_passages($post_id){
		$post = get_post($post_id);
		$app_token = get_sermonpress_setting('sermon_esv_token');
		if($post->post_type == 'sermon' && $app_token != ''){
			$passages = get_post_meta($post_id, 'sermon_passages', true);
			$html = '';
			$pcount = 0;
			if(is_array($passages) && !empty($passages)){
				foreach($passages as $p){
					$pc = urlencode($p);
					$url = "https://api.esv.org/v3/passage/html/?q=".$pc."&include-chapter-numbers=true&include-first-verse-numbers=true&include-footnotes=false&include-footnote-body=false&include-crossrefs=false&include-headings=false&include-subheadings=true&include-surrounding-chapters=false&include-audio-link=false&include-short-copyright=false";
					$options = array(
					  'http'=>array(
					    'method'=>"GET",
					    'header'=>"Accept: application/json\r\n" .
					              "Authorization: Token ".$app_token."\r\n" // i.e. An iPad
					  )
					);
					$context = stream_context_create($options);
					$vhtml = json_decode(file_get_contents($url, false, $context), true);

					$html .= '<div class="passage" id="passage-'.$pcount.'">';
					foreach($vhtml['passages'] as $pass){
						$html .= $pass;
					}
					$html .= '</div>';
				}
			}
			update_post_meta($post_id, 'sermon_passages_html', $html);
		}
	}
	add_action('save_post', 'sermonpress_download_passages', 99, 1);

	//Sermon Front End Browse By Filters
	function sermonpress_adjust_browse_by_for_sermons($query){
		 if ( !is_admin() && $query->is_main_query() && is_post_type_archive('sermon') ) {
		 	//Adjust Query
		 	if(isset($_GET['browseby']) && isset($_GET['v'])){
		 		switch($_GET['browseby']){
					case 'topic':
					case 'series':
					case 'speaker':
					case 'book':
						 $taxquery = array(
					        array(
					            'taxonomy' => $_GET['browseby'],
					            'field' => 'slug',
					            'terms' => array( $_GET['v'] ),
					        )
					    );
					    $query->set( 'tax_query', $taxquery );
						break;
					case 'year':
						$dateOne = $_GET['v'] . '-01-01 00:00:00';
						$dateTwo = $_GET['v'] . '-12-31 23:59:59';
						$meta_query = array(
							array(
								'key' => 'sermon_date',
								'value' => array($dateOne, $dateTwo),
								'compare' => 'BETWEEN',
								'type' => 'DATETIME'
							)
						);
						$query->set( 'meta_query', $meta_query );
						break;
		 		}
		 	} elseif(isset($_GET['browseby']) && $_GET['browseby'] == 'featured'){
		 		$meta_query = array(
					array(
						'key' => 'sermon_featured',
						'value' => 'yes'
					)
				);
				$query->set( 'meta_query', $meta_query );
		 	}
		 }
	}
	add_filter('pre_get_posts', 'sermonpress_adjust_browse_by_for_sermons');


?>
