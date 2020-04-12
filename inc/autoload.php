<?php

	//Declare Global Variables
	global $sermonpress_settings;
	$sermonpress_settings = array();

	//Action for before sermonpress loaded
	do_action('sermonpress_before_load');

	//Load Sermon Post Type
	sermonpress_load_inc('cpt/sermon.php');

	//Activation and Deactivation Functions
	sermonpress_load_inc('init.php');

	//Load Custom Taxonomies
	sermonpress_load_inc('taxonomies/load-taxonomies.php');

	//Enqueue Needed Scripts
	sermonpress_load_inc('enqueue-scripts.php');

	//AJAX Handler
	sermonpress_load_inc('ajax-handler.php');

	//Load Templates Handler
	sermonpress_load_inc('templates-handler.php');

	//Load various helper functions for the SermonPress plugin.
	sermonpress_load_inc('helpers.php');

	//Load Settings Page
	sermonpress_load_inc('admin/settings.php');

	//Load Embedder Tool
	sermonpress_load_inc('embed/embedder.php');

	//Add Nav Links to Menu Builder in Wordpress
	sermonpress_load_inc('admin/menu-builder.php');

	//Load Bundled Plugin Management System
	sermonpress_load_inc('bpms/_config.php');

	//Action for after sermonpress loaded
	do_action('sermonpress_after_load');

	//The SermonPress Inc Loader Function
	function sermonpress_load_inc($path){
		include_once(SERMONPRESS_DIR . 'inc/' . $path);
	}

?>
