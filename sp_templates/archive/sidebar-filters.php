<?php
	$url_base = get_post_type_archive_link('sermon') . '?browseby=';
	$sidebar_filters = array(
		'latest' => array('href' => site_url() . '/sermons/', 'label' => 'Latest'),
		'featured' => array('label' => 'Featured'),
		'topic' => array('label' => 'Topic'),
		'book' => array('label' => 'Book'),
		'series' => array('label' => 'Series'),
		'year' => array('label' => 'Year'),
		'speaker' => array('label' => 'Speaker')
	);
	$sidebar_filters = apply_filters('sermonpress_sermon_archive_filters', $sidebar_filters, $url_base);
	if(get_option('sermonpress_settings')){
		foreach($sidebar_filters as $k => $sbf){
			$show = get_sermonpress_setting('show_filter_'.$k);
			if(!$show){
				unset($sidebar_filters[$k]);
			}
		}
	}
?>
<div class="sidebar-filter">
	<?php if(apply_filters('sermonpress_show_sermon_archive_search', true)) : ?>
	<h4><?php echo apply_filters('sermonpress_sermon_archive_search_text', __('Search Sermons')) ?></h4>
	<div class="sermon-search-holder">
		<form action="" method="GET">
			<input type="text" name="s" placeholder="<?php echo apply_filters('sermonpress_sermon_archive_search_placeholder', __('Enter text here...')) ?>"<?php if(isset($_GET['s'])) : ?> value="<?php echo $_GET['s'] ?>"<?php endif; ?>/>
			<button type="submit"></button>
		</form>
	</div>
	<?php endif; ?>
	<?php if(apply_filters('sermonpress_show_sermon_archive_filters', true)) : ?>
	<h4><?php echo apply_filters('sermonpress_sermon_archive_browse_text', __('Browse By')) ?></h4>
	<ul class="filter-list">
		<?php
			$sidebar_filters_desktop = apply_filters('sermonpress_sermon_archive_filters_desktop', $sidebar_filters);
			foreach($sidebar_filters_desktop as $k => $sfd) :
				if(isset($sfd['href'])) :
		?>
		<li><a class="<?php if(!isset($_GET['browseby']) || (isset($_GET['browseby']) && $_GET['browseby'] == $k)) echo 'current'?>" href="<?php echo $sfd['href'] ?>"><?php echo (isset($sfd['label'])) ? $sfd['label'] : ucwords($k); ?></a></li>
		<?php
				else:
		?>
		<li><a class="<?php if(isset($_GET['browseby']) && $_GET['browseby'] == $k) echo 'current'?>" href="<?php echo $url_base . $k ?>"><?php echo (isset($sfd['label'])) ? $sfd['label'] : ucwords($k); ?></a></li>
		<?php
				endif;
			endforeach;
		?>
	</ul>
	<div class="filter-drop">
		<?php
			$sidebar_filters_mobile = apply_filters('sermonpress_sermon_archive_filters_mobile', $sidebar_filters);
			if(!empty($sidebar_filters_mobile)) :
		?>
		<select name="filter-dropdown" id="filter-dropdown">
			<?php foreach($sidebar_filters_mobile as $k => $sfd) : ?>
				<?php if(isset($sfd['href'])) : ?>
				<option<?php if(!isset($_GET['browseby']) || (isset($_GET['browseby']) && $_GET['browseby'] == $k)) echo ' selected="selected"'?> href="<?php echo $sfd['href']; ?>"><?php echo (isset($sfd['label'])) ? $sfd['label'] : ucwords($k); ?></option>
				<?php else: ?>
				<option<?php if(isset($_GET['browseby']) && $_GET['browseby'] == $k) echo ' selected="selected"'?> href="<?php echo $url_base . $k ?>"><?php echo (isset($sfd['label'])) ? $sfd['label'] : ucwords($k); ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
