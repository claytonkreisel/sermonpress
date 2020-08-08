<?php

	//The Book Taxonomy

	add_action( 'init', 'create_book_taxonomy', 0 );

	function create_book_taxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Books', 'taxonomy general name' ),
			'singular_name'     => _x( 'Book', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Books' ),
			'all_items'         => __( 'All Books' ),
			'parent_item'       => __( 'Parent Book' ),
			'parent_item_colon' => __( 'Parent Book:' ),
			'edit_item'         => __( 'Edit Book' ),
			'update_item'       => __( 'Update Book' ),
			'add_new_item'      => __( 'Add New Book' ),
			'new_item_name'     => __( 'New Book Name' ),
			'menu_name'         => __( 'Books' ),
		);
		$labels = apply_filters('sermonpress_book_labels', $labels);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'has_archive'		=> true,
			'public'			=> true,
			'publicly_queryable' => true,
			'show_in_menu'		=> true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sermons/books', 'with_front' => false ),
		);

		register_taxonomy( 'book', array( 'sermon' ), $args );
	}

	//Check Books
	add_action('admin_init', 'sermonpress_check_books');
	function sermonpress_check_books(){
		if(get_option('sermonpress_books_installed') != SERMONPRESS_VER || (isset($_GET['take_sermonpress_action']) && $_GET['take_sermonpress_action'] == 'install_books')){
			update_option('sermonpress_books_installed', SERMONPRESS_VER);
			$books = json_decode(file_get_contents(SERMONPRESS_DIR . 'inc/taxonomies/books.json'), true);
			foreach($books as $book){
				if(!term_exists($book['n'], 'book')){
					global $pass_books;
					$pass_books = 'OK';
					$ids = wp_insert_term($book['n'], 'book');
					update_term_meta($ids['term_id'], 'term_order', $book['b']);
					update_term_meta($ids['term_id'], 'book_genre', $book['g']);
					update_term_meta($ids['term_id'], 'book_testiment', $book['t']);
				}
			}
		}
	}

	//Do not allow Book Addition
	add_filter('pre_insert_term', 'sermonpress_block_book_addition', 50, 2);
	function sermonpress_block_book_addition($term, $tax){
		if($tax == 'book'){
			global $pass_books;
			if($pass_books == 'OK'){
				return $term;
			}
			return WP_Error('78005A', __('Sorry but you can\'t add any books to the Bible', 'sermonpress'));
		}
		return $term;
	}

	add_action('pre_delete_term', 'sermonpress_block_book_deletion', 1, 2);
	function sermonpress_block_book_deletion( $term, $taxonomy ) {
		if($taxonomy == 'book'){
			return WP_Error('78005B', __('Sorry but you can\'t delete any books to the Bible', 'sermonpress'));
		}
	}
?>
