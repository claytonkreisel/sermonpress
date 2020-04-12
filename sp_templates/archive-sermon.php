<?php

	/*
	 * Default Hooked Actions for: sermonpress_sermon_archive_template_header
	 * 5 - sermonpress_sermon_archive_template_header (inc/templates-handler.php)
	*/
	do_action('sermonpress_sermon_archive_header');
	
?>
	<section class="archive sermons-library">
		<div class="content-container container">
			<?php do_action('sermonpress_before_sermon_archive') ?>
			<div class="row">
				<div class="col-sm-4 col-lg-3">
					<?php
						/*
						 * Default Hooked Actions for: sermonpress_sermon_archive_template_sidebar
						 * 20 - sermonpress_sermon_archive_template_sidebar_filters (inc/templates-handler.php)
						*/
						do_action('sermonpress_sermon_archive_sidebar');
					?>
				</div>
				<div class="col-sm-8 col-lg-9 main-left-sermon-list">
				<?php
					/*
					 * Default Hooked Actions for: sermonpress_sermon_archive_template_main_content
					 * 10 - sermonpress_sermon_archive_template_main_content_archive_view (inc/templates-handler.php)
					 * 20 - sermonpress_sermon_archive_template_main_content_sermons_list (inc/templates-handler.php)
					 * 30 - sermonpress_sermon_archive_template_main_content_sermons_list_pagination (inc/templates-handler.php)
					*/
					do_action('sermonpress_sermon_archive_main_content');
				?>
				</div>
			</div>
			<?php do_action('sermonpress_after_sermon_archive') ?>
		</div>
	</section>
<?php
	/*
	 * Default Hooked Actions for: sermonpress_sermon_archive_template_footer
	 * 95 - sermonpress_sermon_archive_template_footer (inc/templates-handler.php)
	*/
	do_action('sermonpress_sermon_archive_footer');
?>