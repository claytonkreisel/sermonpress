<?php
	//Include Listings
	if(!isset($_GET['browseby'])):
?>
	<?php if(isset($_GET['s']) && $_GET['s'] != '') : ?>
		<?php 
			global $wp_query;
			$decoded_search = urldecode($_GET['s']);
		?>
		<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_default_search', __('Search results for: "' . $decoded_search . '"'), $decoded_search); ?></h3>
		<p class='series-description'><?php echo apply_filters('sermonpress_sermon_archive_template_library_default_search_count', __($wp_query->found_posts . ' posts were found.'), $wp_query->found_posts); ?></p>
	<?php else : ?>
		<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_latest_title', __('Latest Sermons')) ?></h3>
		<p class='series-description'><?php echo apply_filters('sermonpress_sermon_archive_template_library_latest_instructions', __('Below are some of the latest sermons.')) ?></p>
	<?php endif; ?>
	<div class="sermon-top-border"></div>
<?php endif; ?>