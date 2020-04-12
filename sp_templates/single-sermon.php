<?php

	//Establish the post object
	the_post();
	
	/*
	 * Default Hooked Actions for: sermonpress_single_sermon_template_header
	 * 5 - sermonpress_single_sermon_template_header (inc/templates-handler.php)
	*/
	do_action('sermonpress_single_sermon_header');
	
?>
<section class="single sermon-page">
	<div class="content-container container">
		<?php do_action('sermonpress_single_sermon_before_content') ?>
		<div class="row">
			<?php
				/*
				 * Default Hooked Actions for: sermonpress_single_sermon_template_content
				 * 10 - sermonpress_single_sermon_template_title (inc/templates-handler.php)
				 * 20 - sermonpress_single_sermon_template_media (inc/templates-handler.php)
				 * 30 - sermonpress_single_sermon_template_synopsis (inc/templates-handler.php)
				 * 40 - sermonpress_single_sermon_template_scripture (inc/templates-handler.php)
				 * 50 - sermonpress_single_sermon_template_additional_resources (inc/templates-handler.php)
				*/
				do_action('sermonpress_single_sermon_content');
			?>
		</div>
		<?php do_action('sermonpress_single_sermon_after_content') ?>
	</div>
</section>
<?php
	/*
	 * Default Hooked Actions for: sermonpress_single_sermon_template_header
	 * 95 - sermonpress_single_sermon_template_footer (inc/templates-handler.php)
	*/
	do_action('sermonpress_single_sermon_footer');
?>