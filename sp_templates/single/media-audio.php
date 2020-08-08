<?php
	//Get Audio.
	$audio = get_post_meta(get_the_ID(), 'sermon_audio', true);
	if($audio != '') :
?>
<div class="media-panel active" id="audio-panel">
	<?php do_action('sermonpress_before_single_sermon_media_audio'); ?>
	<div class="row">
		<div class="audio-height-fix col-xs-12 col-sm-4">
			<div class="sermon-image">
				<?php
					echo apply_filters('sermonpress_single_sermon_audio_image', sermonpress_get_sermon_image(get_the_ID(), 'sermon_audio_player'));
				?>
			</div>
		</div>
		<div class="audio-height-fix col-xs-12 col-sm-8">
			<div class="player-holder col-xs-12">
				<div class="audio-player" rel="sermon-audio-player">
					<div class='play'></div>
					<div class='meter'><div class="timeline"><div class="audio-progress"></div></div></div>
					<div class='duration'>00:00</div>
					<div class='volume'></div>
					<div class="clearfix"></div>
				</div>
				<audio controls id="sermon-audio-player">
					<source src="<?php echo $audio; ?>" type="audio/mpeg">
					<?php echo __('Your browser does not support the audio tag.', 'sermonpress'); ?>
				</audio>
			</div>
		</div>
	</div>
	<?php do_action('sermonpress_after_single_sermon_media_audio'); ?>
</div>
<?php endif; ?>
