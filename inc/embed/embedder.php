<?php

	//Load the AutoEmbed Class
	if(!class_exists('SPAutoEmbed')){
		sermonpress_load_inc('embed/AutoEmbed.class.php');
	}

	//Get TO Video
	function sermonpress_get_video_embed($option){
		$vid = new SPAutoEmbed();
		if(strpos($option, 'http://') > -1 || strpos($option, 'https://') > -1){
			$vid->parseUrl($option);
		} else {
			$vid->parseUrl(get_option($option, true));
		}
		return $vid->getEmbedCode();
	}

?>
