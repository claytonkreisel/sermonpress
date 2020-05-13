<?php

/*
Plugin Name: SermonPress
Author: Three Remain Productions
Author URI: https://sermonpress.io
Version: 1.3.1
License: GPL2+
Description: This is a fully customizable sermon library plugin. It comes complete with the ability to add audio and video sermons. You can sort the sermons by speaker, topic, book, series and year given right out of the box. Sermon library looks great and works with most well-coded themes, but it also gives your developers complete control with customizable views which can be incorporated into your theme (much like WooCommerce does) as well as a complete list of action and filter hooks. Add-Ons can be custom made or purchased for additional features.
Text Domain: sermonpress
*/

	//Define Core Constants
	define('SERMONPRESS_DIR', plugin_dir_path(__FILE__));
	define('SERMONPRESS_URL', plugin_dir_url(__FILE__));
	define('SERMONPRESS_VER', "1.3.1");
	define('SERMONPRESS_DB_VER', 1.0);

	//Load the activation and deactivation functions
	register_activation_hook( __FILE__, 'sermonpress_activation' );
	register_deactivation_hook( __FILE__, 'sermonpress_deactivation' );

	//Include Library Loader
	include_once(SERMONPRESS_DIR . 'inc/autoload.php');
