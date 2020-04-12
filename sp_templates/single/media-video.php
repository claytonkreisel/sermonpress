<?php
	//Get Audio.
	$video = get_post_meta(get_the_ID(), 'sermon_video', true);
	if($video != '') :
?>
<div class="media-panel active" id="video-panel">
	<?php do_action('sermonpress_before_single_sermon_media_video'); ?>
	<div class="player-holder">
		<div class="video-holder">
			<div class="video-center">
				<?php echo sermonpress_get_video_embed($video); ?>
			</div>
		</div>
	</div>
	<?php do_action('sermonpress_after_single_sermon_media_video'); ?>
</div>
<?php endif; ?>
