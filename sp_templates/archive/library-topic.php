<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby topic-list">
	<h2><?php echo apply_filters('sermonpress_sermon_archive_template_library_topic_title', __('Sermon Topic Index')) ?></h2>
	<p><?php echo apply_filters('sermonpress_sermon_archive_template_library_topic_instructions', __('Below are a list of sermon topics available. Feel free to search through them and choose one that sounds interesting.')) ?></p>
</section>
<?php
	endif;
?>
<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<?php do_action('sermonpress_before_sermon_archive_template_library_topic_list'); ?>
	<div class="row">
<?php
		$url_base = get_post_type_archive_link('sermon') . '?browseby=topic&v=';
		$tree = sermonpress_sermon_tax_tree('topic');
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
		<div class="parent-series-count"><?php echo $parent->count; ?> Messages</div>
		<?php
			foreach($parent->children as $child):
				$count++;
		?>
		<div class="child-series"><a href="<?php echo $url_base . $child->slug; ?>"><?php echo $child->name; ?></a></div>
		<div class="child-series-count"><?php echo $child->count; ?> Messages</div>
		<?php
			endforeach;
		endforeach;
		echo '</div>';
?>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_template_library_topic_list'); ?>
</section>
<?php
	else:
		$topic = get_term_by('slug', $_GET['v'], 'topic');
		if($topic):
?>
	<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_topics_single_topic_title', __($topic->name), $topic->name); ?></h3>
<?php
	if($topic->description != ''):
?>
	<p class='topic-description'><?php echo nl2br($topic->description); ?></p>
<?php endif; ?>
	<div class="sermon-top-border"></div>
<?php
		endif;
	endif;
?>
