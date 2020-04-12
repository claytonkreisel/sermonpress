<?php if(get_post_meta(get_the_ID(), 'sermon_passages_html', true)) : ?>
<div class="scriptures col-xs-12">
	<?php do_action('sermonpress_before_single_sermon_scripture'); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="section-holder">
				<?php echo apply_filters('sermonpress_single_sermon_scripture', get_post_meta(get_the_ID(), 'sermon_passages_html', true)); ?>
			</div>
		</div>
	</div>
	<?php do_action('sermonpress_after_single_sermon_scripture'); ?>
</div>
<?php endif; ?>