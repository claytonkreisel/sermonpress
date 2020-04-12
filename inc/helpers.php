<?php

	//Get SermonPress Settings Page URL
	function sermonpress_get_settings_url($tab = false){
		if($tab){
			$tab = '#tab-' . $tab;
		} else {
			$tab = '';
		}
		return get_admin_url(null, 'admin.php?page=sermonpress-settings'.$tab);
	}

	//Mime Icon Return
	function sermonpress_mime_icon($mime, $i = true){
		$tag = 'sp-file-empty';
		switch($mime){
			case 'application/pdf':
				$tag = apply_filters('sermonpress_icon_sp-file-empty', 'sp-file-pdf');
				break;
			case 'audio/aiff':
			case 'audio/x-aiff':
			case 'audio/x-mpeg-3':
			case 'audio/mpeg3':
			case 'audio/mpeg':
			case 'audio/wav':
			case 'audio/x-wav':
				$tag = apply_filters('sermonpress_icon_sp-file-music', 'sp-file-music');
				break;
			case 'image/jpeg':
			case 'image/png':
			case 'image/gif':
			case 'image/tiff':
				$tag = apply_filters('sermonpress_icon_sp-file-picture', 'sp-file-picture');
				break;
			case 'application/msword':
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.template':
				$tag = apply_filters('sermonpress_icon_sp-file-word', 'sp-file-word');
				break;
			case 'application/excel':
			case 'application/x-excel':
			case 'application/x-msexcel':
			case 'application/vnd.ms-excel':
			case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			case 'application/vnd.openxmlformats-officedocument.spreadsheetml.template':
			case 'application/vnd.ms-excel.sheet.binary.macroEnabled.12':
				$tag = apply_filters('sermonpress_icon_sp-file-excel', 'sp-file-excel');
				break;
			case 'application/vnd.oasis.opendocument.text':
			case 'application/vnd.oasis.opendocument.presentation':
				$tag = apply_filters('sermonpress_icon_sp-file-openoffice', 'sp-file-openoffice');
				break;
			case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
			case 'application/vnd.ms-powerpoint':
				$tag = apply_filters('sermonpress_icon_sp-display', 'sp-display');
				break;
		}

		$tag = apply_filters('sermonpress_attachement_icon', $tag, $mime, $i);

		if($i) return '<i class="'.$tag.'"></i>';
		return $tag;
	}

	//Performs Sermon Taxonomy tree orginization
	function sermonpress_sermon_tax_tree($tax){
		$tree = array();
		$terms = get_terms($tax, array(
			'hierarchical' => true,
			'orderby' => 'name',
			'order' => 'ASC'
		));

		//Establish Parents
		foreach($terms as $t){
			if($t->parent == 0){
				$tree[$t->term_id] = $t;
				$tree[$t->term_id]->children = array();
			}
		}

		//Grant Children
		foreach($terms as $t){
			if($t->parent != 0){
				$tree[$t->parent]->children[] = $t;
			}
		}

		//return $terms;
		return $tree;
	}

	//Default List of sermon books
	function sermonpress_sermon_books($test = false){

		$old = array(
			'genesis',
			'exodus',
			'leviticus',
			'numbers',
			'deuteronomy',
			'joshua',
			'judges',
			'ruth',
			'1-samuel',
			'2-samuel',
			'1-kings',
			'2-kings',
			'1-chronicles',
			'2-chronicles',
			'ezra',
			'nehemiah',
			'esther',
			'job',
			'psalms',
			'proverbs',
			'ecclesiastes',
			'song-of-solomon',
			'isaiah',
			'jeremiah',
			'lamentations',
			'ezekiel',
			'daniel',
			'hosea',
			'joel',
			'amos',
			'obadiah',
			'jonah',
			'micah',
			'nahum',
			'habakkuk',
			'zephaniah',
			'haggai',
			'zechariah',
			'malachi'
		);

		$new = array(
			'matthew',
			'mark',
			'luke',
			'john',
			'acts',
			'romans',
			'1-corinthians',
			'2-corinthians',
			'galatians',
			'ephesians',
			'philippians',
			'colossians',
			'1-thessalonians',
			'2-thessalonians',
			'1-timothy',
			'2-timothy',
			'titus',
			'philemon',
			'hebrews',
			'james',
			'1-peter',
			'2-peter',
			'1-john',
			'2-john',
			'3-john',
			'jude',
			'revelation'
		);

		$old = apply_filters('sermonpress_old_testiment_books', $old);
		$new = apply_filters('sermonpress_old_testiment_books', $new);

		$books = array_merge($old, $new);
		if($test){
			if($test == 'old'){
				$books = $old;
			} elseif( $test == 'new'){
				$books = $new;
			}
		}

		//return $terms;
		return $books;
	}

	//Counts sermons for sort
	function sermon_count_sort($a, $b){
		if($a->count > $b->count){
			return -1;
		} elseif($a->count < $b->count) {
			return 1;
		} else {
			return 0;
		}
	}

	function get_sermonpress_setting($tag = false){
		if($tag){
			global $sermonpress_settings;
			if(empty($sermonpress_settings)){
				$sermonpress_settings = get_option('sermonpress_settings');
			}
			if(isset($sermonpress_settings[$tag])){
				return $sermonpress_settings[$tag];
			}
		}
		return false;
	}

	//Single Sermon Template Audio Picture
	function sermonpress_get_sermon_image( $post_id, $context = 'sermon_image' ) {
    	$post = get_post($post_id);

		//Check Sermon Image in Post

		$s_img = get_post_meta(get_the_ID(), 'sermon_image', true);

		if($s_img){
			$img_src = wp_get_attachment_image_src( get_post_meta(get_the_ID(), 'sermon_image', true), 'large' );
			$html = '';
			if(isset($img_src[0]) && $img_src[0] != ''){
				$html = '<img src="'.$img_src[0].'" title="'.get_the_title().'"></img>';
				return apply_filters('sermonpress_single_sermon_image', $html, $context);
			}
		}

    	//Check Series
		$series_list = get_the_terms($post_id, 'series');
		$image = false;
		if(is_array($series_list)) {
			foreach($series_list as $sp){
				if(!$image){
					$banner = get_term_meta($sp->term_id, 'series_banner', true);
					$banner = wp_get_attachment_image_src($banner, 'large');
					if($banner != ''){
						$image = true;
						$img_src = $banner[0];
						$img_name = $sp->name;
						$html = '<img src="'.$img_src.'" alt="'.$img_name.'" />';
						return apply_filters('sermonpress_single_sermon_image', $html, $context);
					}
				}
			}
		}

		//Check Theme Options
		if(!$image){
			$default_pic = get_sermonpress_setting('sermon_default_picture');
			if(isset($default_pic) && $default_pic != ''){
				$html = wp_get_attachment_image($default_pic, 'large');
				return apply_filters('sermonpress_single_sermon_image', $html, $context);
			}
		}

	    return apply_filters('sermonpress_single_sermon_image', "", $context);
	}



?>
