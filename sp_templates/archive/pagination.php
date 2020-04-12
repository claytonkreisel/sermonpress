<section class='sermon-pagination'>
	<?php do_action('sermonpress_before_sermon_archive_pagination'); ?>
	<?php 
		$args = array(
			'base'               => preg_replace('/\?.*/', '/', get_pagenum_link()) . '%_%',
			'show_all'           => False,
			'end_size'           => 1,
			'mid_size'           => 2,
			'prev_next'          => True,
			'prev_text'          => __('«'),
			'next_text'          => __('»'),
			'type'               => 'list',
			'add_args'           => False,
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => ''
		);
		echo paginate_links($args);
	?>
	<?php do_action('sermonpress_after_sermon_archive_pagination'); ?>
</section>
