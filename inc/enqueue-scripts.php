<?php

	//Register Added on Scripts for both admin and front-end
	add_action('wp_enqueue_scripts', 'sermonpress_register_scripts', 1);
	add_action('admin_enqueue_scripts', 'sermonpress_register_scripts', 1);
	function sermonpress_register_scripts(){
		wp_register_style('sermonpress-icons', SERMONPRESS_URL . 'assets/css/sermonpress-icons.css');
		wp_register_style('sermonpress', SERMONPRESS_URL . 'assets/css/sermonpress.css');
		wp_register_style('bootstrap', SERMONPRESS_URL . 'assets/css/bootstrap.min.css');
		wp_register_style('bootstrap-xl', SERMONPRESS_URL . 'assets/css/bootstrap.xl.css');
		wp_register_style('sermonpress_admin', SERMONPRESS_URL . 'assets/css/admin.css');
		wp_register_script('edit-tags-custom', SERMONPRESS_URL . 'assets/js/edit-tags.js', array('jquery'), false, true);
		wp_register_script('bootstrap', SERMONPRESS_URL . 'assets/js/bootstrap.min.js', array('jquery'), false, true);
	}
	
	//Include files in the backend
	add_action('admin_enqueue_scripts', 'sermonpress_enqueue_admin_scripts', 2);
	function sermonpress_enqueue_admin_scripts(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'edit-tags-custom' );
		wp_enqueue_style( 'sermonpress_admin' );
		wp_enqueue_style( 'sermonpress-icons' );
	}
	
	//Include files in the frontend
	add_action('wp_enqueue_scripts', 'sermonpress_enqueue_front_scripts', 2);
	function sermonpress_enqueue_front_scripts(){
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'bootstrap-xl' );
		wp_enqueue_style( 'sermonpress-icons' );
		wp_enqueue_style( 'sermonpress' );
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'bootstrap' );
		
		//Single Sermon
		if(is_singular('sermon')){
			wp_enqueue_script('single-sermon', SERMONPRESS_URL . 'assets/js/single-sermon.js', array('jquery'), false, true);
		}
		
		// Sermon Archive
		if(is_post_type_archive('sermon')){
			wp_enqueue_script('archive-sermon', SERMONPRESS_URL . 'assets/js/archive-sermon.js', array('jquery'), false, true);
		}
	}

?>