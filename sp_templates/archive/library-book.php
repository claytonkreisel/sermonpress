<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<h2><?php echo apply_filters('sermonpress_sermon_archive_template_library_books_title', __('Sermon Bible Books Index')); ?></h2>
	<p><?php echo apply_filters('sermonpress_sermon_archive_template_library_books_instruction', __('Search for sermons by the texts used in that sermon. Click on a book below.')); ?></p>
</section>
<?php
	endif;
?>
<?php
	//Include Listings
	if(!isset($_GET['v'])):
?>
<section class="sermon-browseby series-list">
	<?php do_action('sermonpress_before_sermon_archive_template_library_books_list'); ?>
	<div class="row">
<?php
		$url_base = get_post_type_archive_link('sermon') . '?browseby=book&v=';
		$old = sermonpress_sermon_books('old');
		$new = sermonpress_sermon_books('new');
?>
		<div class="col-sm-12 col-md-6">
			<div class="parent-series"><?php echo apply_filters('sermonpress_sermon_archive_template_library_books_old_testament_title', __('Old Testament')); ?></div>
		<?php
			foreach($old as $b):
				$book = get_term_by('slug', $b, 'book');
		?>
			<div class="child-series"><a href="<?php echo $url_base . $book->slug; ?>"><?php echo $book->name; ?></a></div>
			<div class="child-series-count"><?php echo $book->count; ?> Messages</div>
		<?php
			endforeach;
		?>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="parent-series"><?php echo apply_filters('sermonpress_sermon_archive_template_library_books_new_testament_title', __('New Testament')); ?></div>
		<?php
			foreach($new as $b):
				$book = get_term_by('slug', $b, 'book');
		?>
			<div class="child-series"><a href="<?php echo $url_base . $book->slug; ?>"><?php echo $book->name; ?></a></div>
			<div class="child-series-count"><?php echo $book->count; ?> Messages</div>
		<?php
			endforeach;
		?>
		</div>
	</div>
	<?php do_action('sermonpress_after_sermon_archive_template_library_books_list'); ?>
</section>
<?php
	else:
		$book = get_term_by('slug', $_GET['v'], 'book');
		if($book):
?>
	<h3><?php echo apply_filters('sermonpress_sermon_archive_template_library_books_single_book_title', __('Sermons from ' . $book->name), $book->name); ?></h3>
<?php
	if($book->description != ''):
?>
	<p class='series-description'><?php echo nl2br($book->description); ?></p>
<?php endif; ?>
	<div class="sermon-top-border"></div>
<?php
		endif;	
	endif;
?>