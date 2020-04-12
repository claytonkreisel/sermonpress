<?php
	$video_active = ' active';
	$audio_active = '';
	if(isset($_GET['player'])){
		if($_GET['player'] == 'audio'){
			$audio_active = ' active';
			$video_active = '';
		}
	}
?>
<div class="media-tabs">
	<?php do_action('sermonpress_before_single_sermon_media_tabs'); ?>
	<div class="media-tab<?php echo $video_active; ?>" id='video-tab' rel='video-panel'>
		<h4><?php echo apply_filters('sermonpress_single_sermon_media_tab_video', __('Video')); ?></h4>
	</div>
	<div class="media-tab<?php echo $audio_active; ?>" id='audio-tab' rel='audio-panel'>
		<h4><?php echo apply_filters('sermonpress_single_sermon_media_tab_audio', __('Audio')); ?></h4>
	</div>
	<div class="clearfix"></div>
	<?php do_action('sermonpress_after_single_sermon_media_tabs'); ?>
</div>
