<?php if(get_post()->post_content != '') : ?>
<div class="synopsis col-xs-12">
	<?php do_action('sermonpress_before_single_sermon_synopsis'); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="section-holder">
				<h3><?php echo apply_filters('sermonpress_single_sermon_synopsis_title', __('Sermon Synopsis')); ?></h3>
				<?php the_content() ?>
			</div>
		</div>
	</div>
	<?php do_action('sermonpress_after_single_sermon_synopsis'); ?>
</div>
<?php endif; ?>