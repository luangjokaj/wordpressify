<?php get_header(); ?>
<!-- container -->
<div class="container">
	<div id="primary" class="not-found">
		<section class="error-404 not-found">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'lk-wordpress-theme' ); ?></h1>
			<img src="<?php echo get_template_directory_uri(); ?>/img/sad.svg" alt="Nothing Found 😔" class="sad-icon">
			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyfifteen' ); ?></p>

				<?php get_search_form(); ?>
			</div>
		</section>
	</div>
</div>
<!-- /container -->
<?php get_footer(); ?>
