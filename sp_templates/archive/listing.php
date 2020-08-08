<div class="sermon" id="sermon-<?php echo get_the_ID(); ?>">
	<?php do_action('sermonpress_before_sermon_archive_listing'); ?>
	<?php 
		
		//Short Description
		$desc = get_post_meta(get_the_ID(), 'sermon_short_text', true);
		
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
					$series = ', ';
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
		
		//Sermon Audio
		$audio = (get_post_meta(get_the_ID(), 'sermon_audio', true) != '') ? true : false;
		
		//Sermon Video
		$video = (get_post_meta(get_the_ID(), 'sermon_video', true) != '') ? true : false;
		
		//Sermon Date
		$date = new DateTime(get_post_meta(get_the_ID(), 'sermon_date', true), wp_timezone());
	?>
	<div class="sermon-listing-header">
		<a href="<?php the_permalink(); ?>" class="sermon-link"><h4><?php echo apply_filters('sermonpress_sermon_archive_listing_title', the_title()); ?></h4></a>
		<?php if($desc != '' && apply_filters('sermonpress_sermon_archive_listing_short_description_show', true)) : ?><div class="sermon-short"><?php echo apply_filters('sermonpress_sermon_archive_listing_short_description', __($desc)) ?></div><?php endif; ?>
	</div>
	<?php if($passages != '' && apply_filters('sermonpress_sermon_archive_listing_passages_show', true)) : ?><div class="sermon-passages"><?php echo apply_filters('sermonpress_sermon_archive_listing_passages', __($passages)) ?></div><?php endif; ?>
	<?php if($series != '' && apply_filters('sermonpress_sermon_archive_listing_series_show', true)) : ?><div class="sermon-series"><?php echo apply_filters('sermonpress_sermon_archive_listing_series', __('Series: ' . $series)) ?></div><?php endif; ?>
	<div class="sermon-date"><?php if(apply_filters('sermonpress_sermon_archive_listing_date', true)) : ?><?php echo $date->format(apply_filters('sermonpress_sermon_archive_listing_date_format', 'F j, Y')); ?><?php endif;?> <?php echo ($speakers != '' && apply_filters('sermonpress_sermon_archive_lisiting_show_speakers', true)) ?  'by ' . $speakers : '' ;?></div>
	<div class="sermon-icons">
	<?php if($video) : ?>
		<a href="<?php echo get_the_permalink() ?>?player=video" class="<?php echo apply_filters('sermonpress_sermon_archive_listing_icon_video', 'sp-film'); ?>"></a>
	<?php endif; ?>
	<?php if($audio) : ?>
		<a href="<?php echo get_the_permalink() ?>?player=audio" class="<?php echo apply_filters('sermonpress_sermon_archive_listing_icon_audio', 'sp-headphones'); ?>"></a>
	<?php endif; ?>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_listing'); ?>
</div>