<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<h2><?php echo apply_filters('sermonpress_sermon_archive_template_library_series_title', __('Sermon Series Index')) ?></h2>
	<p><?php echo apply_filters('sermonpress_sermon_archive_template_library_series_instructions', __('Below are a list of sermon series available. Feel free to search through them and choose one that sounds interesting.')) ?></p>
</section>
<?php
	endif;
?>
<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<?php do_action('sermonpress_before_sermon_archive_template_library_series_list'); ?>
	<div class="row">
<?php
		$url_base = get_post_type_archive_link('sermon') . '?browseby=series&v=';
		$tree = sermonpress_sermon_tax_tree('series');
		$tcount = 0;
		foreach($tree as $parent){
			$tcount++;
			$tcount += count($parent->children);
		}
		$tcount = round($tcount / 2);
		$count = 0;
		$divflag = true;
		echo '<div class="col-sm-12 col-md-6">';
		foreach($tree as $parent):
			$count++;
			if(($count > $tcount) && $divflag){
				$divflag = false;
				echo '</div><div class="col-sm-12 col-md-6">';
			}
		?>
		<div class="parent-series"><a href="<?php echo $url_base . $parent->slug; ?>"><?php echo $parent->name; ?></a></div>
		<?php
			foreach($parent->children as $child):
				$count++;
		?>
		<div class="child-series"><a href="<?php echo $url_base . $child->slug; ?>"><?php echo $child->name; ?></a></div>
		<div class="child-series-count"><?php echo $child->count; ?> <?php __('Messages', 'sermonpress'); ?></div>
		<?php
			endforeach;
		endforeach;
		echo '</div>';
?>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_template_library_series_list'); ?>
</section>
<?php
	else:
		$series = get_term_by('slug', $_GET['v'], 'series');
		if($series):
?>
	<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_series_single_series_title', __($series->name), $series->name); ?></h3>
<?php
	if($series->description != ''):
?>
	<p class='series-description'><?php echo nl2br($series->description); ?></p>
<?php endif; ?>
	<div class="sermon-top-border"></div>
<?php
		endif;
	endif;
?>
