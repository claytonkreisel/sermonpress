<?php

	//Speakers
	$speakers_list = get_the_terms(get_the_ID(), 'speaker');
	$speakers = '';
	if(is_array($speakers_list)) {
		foreach($speakers_list as $sp){
			if(reset($speakers_list) !== $sp) {
				$speakers .= ', ';
			}
			$speakers .= '<a class="sermon-speaker-list" href="'.site_url().'/sermons/?browseby=speaker&v=' . $sp->slug . '">' . $sp->name . '</a>';
		}
	}
	
	//Series
	$series_list = get_the_terms(get_the_ID(), 'series');
	$series = '';
	if(is_array($series_list)) {
		foreach($series_list as $sp){
			if(reset($series_list) !== $sp) {
				$series .= ', ';
			}
			$series .= '<a class="sermon-series-list" href="'.site_url().'/sermons/?browseby=series&v=' . $sp->slug . '">' . $sp->name . '</a>';
		}
	}
	
	//Passages
	$passage_list = get_post_meta(get_the_ID(), 'sermon_passages', true);
	$passages = '';
	if(is_array($passage_list)) {
		foreach($passage_list as $sp){
			if(reset($passage_list) !== $sp) {
				$passages .= ', ';
			}
			$passages .=  $sp;
		}
	}
	
	//Sermon Audio DL
	$audio_dl = (get_post_meta(get_the_ID(), 'sermon_audio', true) != '') ? get_post_meta(get_the_ID(), 'sermon_audio', true) : false;
	
	//Sermon Video DL
	$video_dl = (get_post_meta(get_the_ID(), 'sermon_video_dl', true) != '') ? get_post_meta(get_the_ID(), 'sermon_video_dl', true) : false;
	
	//Sermon Friday Focus
	$friday_focus = (get_post_meta(get_the_ID(), 'sermon_friday_focus', true) != '') ? get_post_meta(get_the_ID(), 'sermon_friday_focus', true) : false;
	
	//Sermon Date
	$date = new DateTime(get_post_meta(get_the_ID(), 'sermon_date', true), new DateTimeZone('America/Chicago'));
	
	//Sermon Links
	$links = get_post_meta(get_the_ID(), 'sermon_links_group', true);

	//Sermon Attachments
	$friday_focus = (get_post_meta(get_the_ID(), 'sermon_attachments') != '') ? get_post_meta(get_the_ID(), 'sermon_attachments', true) : false;

?>
<div class="info-holder">
	<div class="row">
		<?php do_action('sermonpress_before_single_sermon_media_info'); ?>
		<div class="col-xs-12 col-sm-8">
			<div class="sermon-title"><h3><?php apply_filters('sermonpress_single_sermon_media_info_title', the_title()); ?></h3></div>
			<div class="info sermon-date"><?php if(apply_filters('sermonpress_single_sermon_media_info_show_date', true)) : ?><?php echo $date->format(apply_filters('sermonpress_single_sermon_media_info_date_format', 'F j, Y')); ?><?php endif;?> <?php echo ($speakers != '' && apply_filters('sermonpress_single_sermon_media_info_show_speakers', true)) ?  'by ' . $speakers : '' ;?></div>
			<?php if($series != '') : ?><div class="info sermon-series"><span class="info-label">Series:</span><span><?php echo $series ?></span></div><?php endif; ?>
			<?php if($passages != '') : ?><div class="info sermon-passages"><span class="info-label">Passages:</span><span><?php echo $passages ?></span></div><?php endif; ?>
		</div>
		<div class="hidden-xs col-sm-4">
			<div class="sermon-downloads">
				<?php if($audio_dl || $video_dl) : ?>
					<span><?php echo apply_filters('sermonpress_single_sermon_media_info_downloads_label', __('Downloads:')); ?></span>
				<?php endif; ?>
				<?php if($audio_dl) :?>
					<a href="<?php echo $audio_dl?>"><i class="<?php echo apply_filters('sermonpress_icon_sp-file-music','sp-file-music'); ?>"></i></a>
				<?php endif;?>
				<?php if($video_dl) :?>
					<a href="<?php echo $video_dl?>"><i class="<?php echo apply_filters('sermonpress_icon_sp-file-video','sp-file-video'); ?>"></i></a>
				<?php endif;?>
			</div>
		</div>
		<?php do_action('sermonpress_after_single_sermon_media_info'); ?>
	</div>	
</div>