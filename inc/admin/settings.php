<?php

	add_filter( 'mb_settings_pages', 'sermonpress_settings_pages' );
	function sermonpress_settings_pages( $settings_pages ){

		//General Setting Page Declaration
		$settings_pages[] = array(
			'id'            => 'sermonpress-settings',
			'option_name'   => 'sermonpress_settings',
			'position'		=> 80,
			'menu_title'    => __( 'SermonPress', 'sermonpress' ),
			'page_title'    => __( 'SermonPress Settings', 'sermonpress' ),
			'icon_url'      => 'dashicons-sp-sermonpress',
			'columns'		=> 1,
			'tabs'			=> array(
				'general' => 'General',
				'archive' => 'Archive',
				'single' => 'Single Sermons'

			),
			'submenu_title' => __( 'General', 'sermonpress' ), // Note this
		);

		return $settings_pages;
	}

	add_filter( 'rwmb_meta_boxes', 'sermonpress_settings_page_boxes' );
	function sermonpress_settings_page_boxes($meta_boxes){

		//Single Sermon Settings
		$meta_boxes[] = array(
			'id'             => 'single-sermon',
			'tab'			 => 'single',
			'title'          => __( 'Default Sermon Settings', 'sermonpress' ),
			'settings_pages' => 'sermonpress-settings',
			'fields'         => array(
				array(
					'name' => __( 'Default Feature Picture', 'sermonpress' ),
					'id'   => 'sermon_default_picture',
					'desc' => 'The picture to be used if the sermon has no feature picture.',
					'type' => 'single_image'
				)
			),
		);
		$meta_boxes[] = array(
			'id'             => 'single-bible-verse-lookup',
			'tab'			 => 'single',
			'title'          => __( 'Bible Verse Lookup', 'sermonpress' ),
			'settings_pages' => 'sermonpress-settings',
			'fields'         => array(
				array(
					'name' => __( 'ESV Application Token', 'sermonpress' ),
					'id'   => 'sermon_esv_token',
					'desc' => 'You must obtain this token from https://api.esv.org/. For instructions <a target="_blank" href="https://www.sermonpress.io/help-center/bible-verse-lookup-setup/">click here</a>. (The bible verses option in the sermon editor is disabled until a valid application is provided)',
					'type' => 'text'
				)
			),
		);

		$show_filters_options = array(
			'latest' => array('label' => 'Latest'),
			'featured' => array('label' => 'Featured'),
			'topic' => array('label' => 'Topic'),
			'book' => array('label' => 'Book'),
			'series' => array('label' => 'Series'),
			'year' => array('label' => 'Year'),
			'speaker' => array('label' => 'Speaker')
		);
		$show_filters_options = apply_filters('sermonpress_sermon_archive_filters_settings', $show_filters_options);

		$tmp_fields = array();

		foreach($show_filters_options as $k => $v){
			$tmp_fields[] = array(
				'name' => __('Show ' . $v['label'] . '?', 'sermonpress'),
				'id' => 'show_filter_' . $k,
				'desc' => 'Do you want to show the "' . $v['label'] . '" filter on the archive page?',
				'type' => 'switch',
				'on_label' => 'Yes',
				'off_label' => 'No',
				'std' => 1
			);
		}

		//Filters and Search Box Settings
		$meta_boxes[] = array(
			'id'             => 'sermonpress-archive-filters',
			'tab'			 => 'archive',
			'title'          => __( 'Filters and Search Box', 'sermonpress' ),
			'settings_pages' => 'sermonpress-settings',
			'fields'         => $tmp_fields
		);

		//General Settings
		$meta_boxes[] = array(
			'id'			 => 'sermonpress-rewrite-slug',
			'tab'			 => 'general',
			'title'			 => 'Permalink Settings',
			'settings_pages' => 'sermonpress-settings',
			'fields'		 => array(
				array(
					'name' => 'Rewrite Slug',
					'id' => 'sermons_rewrite_slug',
					'type' => 'text',
					'desc' => 'The slug that is used for the sermons archive page. (IE example.com/<i>sermons</i>)',
					'std' => 'sermons'
				)
			)
		);

		return $meta_boxes;

	}

	add_action('init', 'sermonpress_load_settings_values', 1);
	function sermonpress_load_settings_values(){
		add_filter('sermonpress_sermons_rewrite_slug', 'sermonpress_load_rewrite_settings');
	}

	function sermonpress_load_rewrite_settings($current){
		$saved = get_sermonpress_setting('sermons_rewrite_slug');
		if(!$saved|| $saved == ''){
			return $current;
		}
		sermonpress_flush_rewrites();
		return $saved;
	}

	function sermonpress_flush_rewrites(){
		flush_rewrite_rules();
	}

	add_action('update_option_sermonpress_settings', 'sermonpress_confirm_esv_api_key', 99, 2);
	add_action('add_option_sermonpress_settings', 'sermonpress_confirm_esv_api_key', 99, 2);
	function sermonpress_confirm_esv_api_key($dep, $value){
		if(isset($value['sermon_esv_token'])){
			$app_token = $value['sermon_esv_token'];
			$pc = urlencode('John 3:16');
			$url = "https://api.esv.org/v3/passage/html/?q=".$pc."&include-chapter-numbers=true&include-first-verse-numbers=true&include-footnotes=false&include-footnote-body=false&include-crossrefs=false&include-headings=false&include-subheadings=true&include-surrounding-chapters=false&include-audio-link=false&include-short-copyright=false";
			$options = array(
			  'http'=>array(
				'method'=>"GET",
				'header'=>"Accept: application/json\r\n" .
						  "Authorization: Token ".$app_token."\r\n" // i.e. An iPad
			  )
			);
			$context = stream_context_create($options);
			if(@!file_get_contents($url, false, $context)){
				unset($value['sermon_esv_token']);
				update_option('sermonpress_settings', $value);
				add_action( 'admin_notices', 'sermonpress_esv_token__error' );
			}
		}
	}

	function sermonpress_esv_token__error() {
		$class = 'notice notice-error';
		$message = __( 'Error: It appears the API token entered for the ESV verse lookup feature was not correct. Please <a href="https://www.sermonpress.io/help-center/bible-verse-lookup-setup/" target="_blank">look here</a> for help setting it up.', 'sermonpress' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message);
	}

	add_action('init', 'sermonpress_confirm_sermonpress_settings_exist');
	add_action('admin_init', 'sermonpress_confirm_sermonpress_settings_exist');
	function sermonpress_confirm_sermonpress_settings_exist(){
		if(!get_option('sermonpress_settings')){
			add_option('sermonpress_settings', array());
		}
	}

?>
