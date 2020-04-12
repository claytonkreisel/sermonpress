jQuery(document).ready(function(){
	
	//Bind the Audio Player
	var audioPlayer = bindAudioPlayers();
	
	//Tabs
	bindTabs();
	
	//Fix Audio Player Height
	fixAudioHeight();
});

jQuery(window).load(function(){
	//Fix Audio Player Height
	fixAudioHeight();
});

jQuery(window).resize(function(){
	//Fix Audio Player Height
	fixAudioHeight();
});

function bindAudioPlayers(){
	var mainPlayer;
	jQuery('.audio-player').each(function(){
		var player = jQuery('audio#' + jQuery(this).attr('rel'));
		var rel = jQuery(this).attr('rel');
		var timeline = jQuery(this).find('.timeline');
		player = player[0];
		mainPlayer = player;
		player.volume = 1;
		jQuery(this).find('.play').on('click', function(e){
			if(player.paused){
				player.play();
				jQuery(this).addClass('pause');
			} else {
				player.pause();
				jQuery(this).removeClass('pause');
			}
		});
		player.ontimeupdate = function(){
			updateTimelineProgress(player, rel);
		};
		player.onloadedmetadata = function(){
			updateTimelineProgress(player, rel);
		};
		timeline.off('click');
		timeline.on('click', function(e){
			var width = jQuery(this).width();
			var posX = jQuery(this).offset().left;
        	changeTimelineProgress(player, rel, ((e.pageX - posX) / width));
		});
		
	});
	return mainPlayer;
}

function updateTimelineProgress(player, rel){
	var panel = jQuery('.audio-player[rel="' + rel + '"]');
	var timeline = panel.find('.audio-progress');
	var time = panel.find('.duration');
	var duration = Math.round(player.duration);
	var curTime = Math.round(player.currentTime);
	var remain = duration - curTime;
	// Minutes and seconds
	var mins = ~~(remain / 60);
	var secs = remain % 60;
	
	// Hours, minutes and seconds
	var hrs = ~~(remain / 3600);
	var mins = ~~((remain % 3600) / 60);
	var secs = remain % 60;
	
	// Output like "1:01" or "4:03:59" or "123:03:59"
	ret = "";
	
	if (hrs > 0)
	    ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
	
	ret += "" + mins + ":" + (secs < 10 ? "0" : "");
	ret += "" + secs;
	
	var progressWidth = (curTime / duration) * 100;
	timeline.css('width', progressWidth + '%');
	time.html('-' + ret);
}

function changeTimelineProgress(player, rel, position){
	var duration = Math.round(player.duration);
	player.currentTime = duration * position;
	updateTimelineProgress(player, rel);
}

function bindTabs(){
	if(jQuery('.media-tabs').length != 0){
		jQuery('.media-panel').removeClass('active');
		var active = jQuery('.media-tab.active');
		jQuery('#' + active.attr('rel')).addClass('active');
		fixAudioHeight();
		jQuery('.media-tab').off('click');
		jQuery('.media-tab').on('click', function(){
			jQuery('.media-tab').removeClass('active');
			jQuery(this).addClass('active');
			jQuery('.media-panel').removeClass('active');
			jQuery('#' + jQuery(this).attr('rel')).addClass('active');
			fixAudioHeight();
		});
	}
}

function fixAudioHeight(){
	jQuery('.audio-height-fix').css('height', 'auto');
	if(jQuery(window).width() > 750){
		var height = 0;
		jQuery('.audio-height-fix').each(function(){
			if(jQuery(this).height() > height){
				height = jQuery(this).height();
			}
			console.log(height);
		});
		jQuery('.audio-height-fix').height(height);
	}
}
