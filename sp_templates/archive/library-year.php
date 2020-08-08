<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<h2><?php echo apply_filters('sermonpress_sermon_archive_template_library_year_title', __('Sermons By Year')) ?></h2>
	<p><?php echo apply_filters('sermonpress_sermon_archive_template_library_year_instructions', __('Search for sermons by the year they were preached.')) ?></p>
</section>
<?php
	endif;
?>
<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<?php do_action('sermonpress_before_sermon_archive_template_library_year_list'); ?>
	<div class="row">
<?php
		$url_base = get_post_type_archive_link('sermon') . '?browseby=year&v=';
		$years = array();
		$cur = (int)date('Y', time());
		for($i = $cur; $i >= 2007; $i--){
			$years[] = $i;
		}
		foreach($years as $y):
			$dateOne = $y . '-01-01 00:00:00';
			$dateTwo = $y . '-12-31 23:59:59';
			$post_query = get_posts(array(
				'post_type' => 'sermon',
				'meta_query' => array(
					array(
						'key' => 'sermon_date',
						'value' => array($dateOne, $dateTwo),
						'compare' => 'BETWEEN',
						'type' => 'DATETIME'
					)
				),
				'posts_per_page' => -1,
				'fields' => 'ids'
			));
		?>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="child-series"><a href="<?php echo $url_base . $y; ?>"><?php echo $y; ?></a></div>
			<div class="child-series-count"><?php echo count($post_query); ?> <?php __('Messages', 'sermonpress'); ?></div>
		</div>
		<?php
			endforeach;
		?>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_template_library_year_list'); ?>
</section>
<?php
	else:
		$year = (isset($_GET['v'])) ? $_GET['v'] : false;
		if($year):
		?>
			<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_year_single_year_title', sprintf(__('Sermons from the year of %s', 'sermonpress'), $year), $year); ?></h3>
			<div class="sermon-top-border"></div>
		<?php
		endif;	
	endif;
?>