<?php

/* This file tells WordPress what template files to use for sermons and their archives.
 * Since Version: 1.0
 * Last Update Version: 1.0
*/

	/*****************************************/
	/*** Template Handler Helper Functions ***/
	/*****************************************/

	//This function grabs the different template parts for SermonPress
	function sermonpress_get_template_part($path){
		$template_part = false;
		if(file_exists(SERMONPRESS_DIR . 'sp_templates/'.$path.'.php')) {
			$template_part = SERMONPRESS_DIR . 'sp_templates/'.$path.'.php';
		}
		if(file_exists(get_stylesheet_directory() . '/sp_templates/'.$path.'.php')) {
			$template_part = get_stylesheet_directory() . '/sp_templates/'.$path.'.php';
		}
		if($template_part) {
			include($template_part);
		}
	}

	/****************************************/
	/**** Single Sermon Template Handler ****/
	/****************************************/

	add_filter( "single_template", "sermonpress_single_sermon_template", 50, 1);
	function sermonpress_single_sermon_template($single_template){
		global $post;

	    if ($post->post_type == 'sermon') {
	    	if(file_exists(SERMONPRESS_DIR . 'sp_templates/single-sermon.php')){
	    		$single_template = SERMONPRESS_DIR . 'sp_templates/single-sermon.php';
			}
			if(file_exists(get_stylesheet_directory() . '/sp_templates/single-sermon.php')){
				$single_template = get_stylesheet_directory() . '/sp_templates/single-sermon.php';
			}
			$single_template = apply_filters('sermonpress_single_sermon_template', $single_template);
	    }

		return $single_template;
	}

	/********************************************/
	/** Single Sermon Template Default Actions **/
	/********************************************/

	//Single Sermon Template Page Header
	function sermonpress_single_sermon_template_header(){
		get_header();
	}
	add_action('sermonpress_single_sermon_header', 'sermonpress_single_sermon_template_header', 5);

	//Single Sermon Template Title
	function sermonpress_single_sermon_template_title(){
		sermonpress_get_template_part('single/title');
	}
	add_action('sermonpress_single_sermon_content', 'sermonpress_single_sermon_template_title', 10);

	//Single Sermon Template Media
	function sermonpress_single_sermon_template_media(){
		sermonpress_get_template_part('single/media');
	}
	add_action('sermonpress_single_sermon_content', 'sermonpress_single_sermon_template_media', 20);

	//Single Sermon Template Synopsis
	function sermonpress_single_sermon_template_synopsis(){
		sermonpress_get_template_part('single/synopsis');
	}
	add_action('sermonpress_single_sermon_content', 'sermonpress_single_sermon_template_synopsis', 30);

	//Single Sermon Template Scripture
	function sermonpress_single_sermon_template_scripture(){
		sermonpress_get_template_part('single/scripture');
	}
	add_action('sermonpress_single_sermon_content', 'sermonpress_single_sermon_template_scripture', 40);

	//Single Sermon Template Scripture
	function sermonpress_single_sermon_template_additional_resources(){
		sermonpress_get_template_part('single/additional-resources');
	}
	add_action('sermonpress_single_sermon_content', 'sermonpress_single_sermon_template_additional_resources', 50);

	//Single Sermon Template Page Fooer
	function sermonpress_single_sermon_template_footer(){
		get_footer();
	}
	add_action('sermonpress_single_sermon_footer', 'sermonpress_single_sermon_template_footer', 95);

	//Single Sermon Template Media Tabs
	function sermonpress_single_sermon_template_media_tabs($audio, $video){
		if($audio != '' && $video != '') {
			sermonpress_get_template_part('single/media-tabs');
		}
	}
	add_action('sermonpress_single_sermon_media', 'sermonpress_single_sermon_template_media_tabs', 10, 2);

	//Single Sermon Template Media
	function sermonpress_single_sermon_template_media_audio($audio, $video){
		sermonpress_get_template_part('single/media-audio');
	}
	add_action('sermonpress_single_sermon_media', 'sermonpress_single_sermon_template_media_audio', 20, 2);

	//Single Sermon Template Synopsis
	function sermonpress_single_sermon_template_media_video($audio, $video){
		sermonpress_get_template_part('single/media-video');
	}
	add_action('sermonpress_single_sermon_media', 'sermonpress_single_sermon_template_media_video', 30, 2);

	//Single Sermon Template Scripture
	function sermonpress_single_sermon_template_media_info($audio, $video){
		sermonpress_get_template_part('single/media-info');
	}
	add_action('sermonpress_single_sermon_media', 'sermonpress_single_sermon_template_media_info', 40, 2);

	/*****************************************/
	/**** Sermon Archive Template Handler ****/
	/*****************************************/

	add_filter( "archive_template", "sermonpress_sermon_archive_template", 50, 1);
	function sermonpress_sermon_archive_template($archive_template){
		global $post;

	    if (is_post_type_archive ( 'sermon' )) {
	    	if(file_exists(SERMONPRESS_DIR . 'sp_templates/archive-sermon.php')){
	    		$archive_template = SERMONPRESS_DIR . 'sp_templates/archive-sermon.php';
			}
			if(file_exists(get_stylesheet_directory() . '/sp_templates/archive-sermon.php')){
				$archive_template = get_stylesheet_directory() . '/sp_templates/archive-sermon.php';
			}
			$archive_template = apply_filters('sermonpress_sermon_archive_template', $archive_template);
	    }

		return $archive_template;
	}

	/*********************************************/
	/** Sermon Archive Template Default Actions **/
	/*********************************************/

	//Sermon Archive Template Page Header
	function sermonpress_sermon_archive_template_header(){
		get_header();
	}
	add_action('sermonpress_sermon_archive_header', 'sermonpress_sermon_archive_template_header', 5);

	//Sermon Archive Template Page Sidebar Filters
	function sermonpress_sermon_archive_template_sidebar_filters(){
		sermonpress_get_template_part('archive/sidebar-filters');
	}
	add_action('sermonpress_sermon_archive_sidebar', 'sermonpress_sermon_archive_template_sidebar_filters', 20);

	//Sermon Archive Template Main Content if Archive View
	function sermonpress_sermon_archive_template_main_content_archive_view(){
		$archive_template_part = "archive/library-default";
		if(isset($_GET['browseby'])){
			switch($_GET['browseby']){
				case 'topic':
					$archive_template_part = "archive/library-topic";
					break;
				case 'year':
					$archive_template_part = "archive/library-year";
					break;
				case 'speaker':
					$archive_template_part = "archive/library-speaker";
					break;
				case 'book':
					$archive_template_part = "archive/library-book";
					break;
				case 'series':
					$archive_template_part = "archive/library-series";
					break;
				case 'featured':
					$archive_template_part = "archive/library-featured";
					break;
				default:
					$archive_template_part = "archive/library-default";
					break;
			}
		}
		$archive_template_part = apply_filters('sermonpress_sermon_archive_main_content_archive_view', $archive_template_part);
		do_action('sermonpress_before_sermon_archive_main_content_archive_view', $archive_template_part);
		sermonpress_get_template_part($archive_template_part);
		do_action('sermonpress_after_sermon_archive_main_content_archive_view', $archive_template_part);
	}
	add_action('sermonpress_sermon_archive_main_content', 'sermonpress_sermon_archive_template_main_content_archive_view', 10);

	//List the actual sermon posts
	function sermonpress_sermon_archive_template_main_content_sermons_list(){
		if((isset($_GET['browseby']) && $_GET['browseby'] != '' && isset($_GET['v']) && isset($_GET['v']) != '') || !isset($_GET['browseby']) || (isset($_GET['browseby']) && $_GET['browseby'] == 'featured')) {
			sermonpress_get_template_part('archive/library');
		}
	}
	add_action('sermonpress_sermon_archive_main_content', 'sermonpress_sermon_archive_template_main_content_sermons_list', 20);

	//List the sermon pagination
	function sermonpress_sermon_archive_template_main_content_sermons_list_pagination(){
		if((isset($_GET['browseby']) && $_GET['browseby'] != '' && isset($_GET['v']) && isset($_GET['v']) != '') || !isset($_GET['browseby']) || (isset($_GET['browseby']) && $_GET['browseby'] == 'featured')) {
			sermonpress_get_template_part('archive/pagination');
		}
	}
	add_action('sermonpress_sermon_archive_main_content', 'sermonpress_sermon_archive_template_main_content_sermons_list_pagination', 30);

	//Sermon Archive Template Page Header
	function sermonpress_sermon_archive_template_footer(){
		get_footer();
	}
	add_action('sermonpress_sermon_archive_footer', 'sermonpress_sermon_archive_template_footer', 95);
?>
