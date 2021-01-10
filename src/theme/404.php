<?php get_header(); ?>
<div class="container">
	<div class="site-content page">
		<h1 class="page-title"><?php _e('Oops! 404', 'wordpressify'); ?></h1>
		<div class="page-content">
			<p class="block">
				<?php _e('It looks like nothing was found at this location. Maybe try a search?', 'wordpressify'); ?>
			</p>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
