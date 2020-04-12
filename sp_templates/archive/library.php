<section class="sermon-listings">
<?php
	do_action('sermonpress_before_sermon_archive_template_listing');
	if(have_posts()) : 
		while(have_posts()) : the_post();
			sermonpress_get_template_part('archive/listing');
		endwhile;
	endif;
	do_action('sermonpress_after_sermon_archive_template_listing');
?>
</section>