<div class="title col-xs-12">
	<?php do_action('sermonpress_before_single_sermon_title'); ?>
	<h1><?php echo apply_filters('sermonpress_single_sermon_title', __(get_the_title())); ?></h1>
	<?php do_action('sermonpress_after_single_sermon_title'); ?>
</div>