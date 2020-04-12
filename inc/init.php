<?php

	//Run these functions on plugin activation
	function sermonpress_activation(){
		update_option('sermonpress_books_installed', '');
	}
	
	//Run these functions on plugin deactivation
	function sermonpress_deactivation(){
		update_option('sermonpress_books_installed', '');
	}

?>