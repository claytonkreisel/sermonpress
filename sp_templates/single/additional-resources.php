<?php

	//Sermon Links
	$links = get_post_meta(get_the_ID(), 'sermon_links_group', true);
	$links = apply_filters('sermonpress_sermon_links', $links, get_the_ID());
	$has = false;
	if(is_array($links)){
		foreach($links as $link){
			if($link['sermon_links_url'] != '' || $link['sermon_links_text'] != ''){
				$has = true;
			}
		}
	}
	if(!$has){
		$links = false;
	}

	//Sermon Attachments
	$atts = (get_post_meta(get_the_ID(), 'sermon_attachments') != '') ? get_post_meta(get_the_ID(), 'sermon_attachments') : false;
	$atts = apply_filters('sermonpress_sermon_attachments', $atts, get_the_ID());

	//Resources
	$resources = false;
	if($links || $atts) $resources = true;

?>
<?php if($resources) : ?>
<div class="resources col-xs-12">
	<div class="row">
		<div class="col-xs-12">
			<div class="section-holder">
				<?php do_action('sermonpress_before_single_sermon_template_additional_resources'); ?>
				<h3><?php echo apply_filters('sermonpress_single_sermon_template_additional_resources_title', __('Additional Resources')); ?></h3>
				<?php if($links): ?>
				<h4><i class="<?php echo apply_filters('sermonpress_single_sermon_template_links_icon', 'sp-link'); ?>"></i><span class="add-label"><?php echo apply_filters('sermonpress_single_sermon_template_links_title', __('Links')); ?></span></h4>
				<ul class="resources">
					<?php if($links) : ?>
						<?php foreach($links as $link): ?>
						<li><a target="_blank" href="<?php echo $link['sermon_links_url'] ?>"><?php echo $link['sermon_links_text'] ?></a></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
				<?php endif; ?>
				<?php if($atts): ?>
				<h4 class="hidden-xs"><i class="<?php echo apply_filters('sermonpress_single_sermon_template_attachments_icon', 'sp-download'); ?>"></i><span class="add-label"><?php echo apply_filters('sermonpress_single_sermon_template_attachments_title', __('Downloads / Files')); ?></span></h4>
				<ul class="hidden-xs resources">
					<?php if($atts) : ?>
						<?php foreach($atts as $att): ?>
							<?php
								$a = get_post($att);
								$asrc = wp_get_attachment_url($att);
								$file_type = get_post_mime_type($att);
							?>
							<li><a target="_blank" href="<?php echo $asrc; ?>"><?php echo $a->post_title; ?></a><?php echo sermonpress_mime_icon($file_type); ?></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
				<?php endif; ?>
				<?php do_action('sermonpress_after_single_sermon_template_additional_resources'); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
