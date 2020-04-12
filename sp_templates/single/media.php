<div class="media col-xs-12">
	<?php
	
		do_action('sermonpress_before_single_sermon_media');
		
		//Sermon Media
		$audio = get_post_meta(get_the_ID(), 'sermon_audio', true);
		$video = get_post_meta(get_the_ID(), 'sermon_video', true);
		
		/*
		 * Default Hooked Actions for: sermonpress_single_sermon_template_content_media
		 * 10 - sermonpress_single_sermon_template_media_tabs (inc/templates-handler.php)
		 * 20 - sermonpress_single_sermon_template_media_audio (inc/templates-handler.php)
		 * 30 - sermonpress_single_sermon_template_media_video (inc/templates-handler.php)
		 * 40 - sermonpress_single_sermon_template_media_info (inc/templates-handler.php)
		*/
		do_action('sermonpress_single_sermon_media', $audio, $video);
		
		do_action('sermonpress_after_single_sermon_media');
		
	?>
</div>
