<?php

	//Handle the Sortable Taxonomy Ajax
	function sermonpress_sort_taxonomy(){
		include_once(SERMONPRESS_DIR . 'assets/ajax/sort-taxonomy.php');
		exit();
	}
	add_action('wp_ajax_sort-taxonomy', 'sermonpress_sort_taxonomy');

?>