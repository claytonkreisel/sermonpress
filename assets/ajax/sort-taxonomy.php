<?php
	global $wpdb;
	$order = $_POST['order'];
	$page = $_POST['page'];
	$tax = $_POST['taxonomy'];
	$numperpage = $_POST['perpage'];
	$startcount = ($numperpage * $page) - ($numperpage);
	
	//Get Current Order.
	$current = get_terms($tax, array(
		'hide_empty' => false
	));
	
	$holder = array();
	
	foreach($current as $c){
		$holder[$c->term_id] = $c;
	}
	unset($current);
	
	//Implement New Order Elements
	foreach($order as $o){
		update_term_meta($holder[$o]->term_id, 'term_order', $startcount);
		$holder[$o]->order_val = $startcount;
		$startcount++;
	}
	
?>