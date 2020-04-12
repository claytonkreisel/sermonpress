<?php

	//List of custom post types
	sermonpress_load_custom_tax('series');
	sermonpress_load_custom_tax('book');
	sermonpress_load_custom_tax('speaker');
	sermonpress_load_custom_tax('topic');
	sermonpress_load_custom_tax('service');

	//Load the custom post type function.
	function sermonpress_load_custom_tax($type){
		sermonpress_load_inc('taxonomies/' . $type . '.php');
	}

?>