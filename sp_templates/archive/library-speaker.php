<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<h2><?php echo apply_filters('sermonpress_sermon_archive_template_library_speaker_title', __('Speaker Index')) ?></h2>
	<p><?php echo apply_filters('sermonpress_sermon_archive_template_library_speaker_instructions', __('Search for sermons by the by the person who delievered them. Click on a speaker below.')) ?></p>
</section>
<?php
	endif;
?>
<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<?php do_action('sermonpress_before_sermon_archive_template_library_speaker_list'); ?>
	<div class="row">
<?php
		$url_base = get_post_type_archive_link('sermon') . '?browseby=speaker&v=';
		$speakers = get_terms('speaker', array(
			'orderby' => 'count',
			'order' => 'DESC'
		));
		usort($speakers, 'sermon_count_sort');
?>
		<?php
			foreach($speakers as $speaker):
		?>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="child-series"><a href="<?php echo $url_base . $speaker->slug; ?>"><?php echo $speaker->name; ?></a></div>
			<div class="child-series-count"><?php echo $speaker->count; ?> <?php __('Messages', 'sermonpress'); ?></div>
		</div>
		<?php
			endforeach;
		?>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_template_library_speaker_list'); ?>
</section>
<?php
	else:
		$speaker = get_term_by('slug', $_GET['v'], 'speaker');
		if($speaker):
?>
	<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_speakers_single_speaker_title', sprintf(__('Sermons by %s', 'sermonpress'), $speaker->name), $speaker->name); ?></h3>
<?php
	if($speaker->description != ''):
?>
	<p class='series-description'><?php echo nl2br($speaker->description); ?></p>
<?php endif; ?>
	<div class="sermon-top-border"></div>
<?php
		endif;	
	endif;
?>