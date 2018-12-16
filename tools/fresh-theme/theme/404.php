<?php get_header(); ?>
<!-- container -->
<div class="container">
	<div id="primary" class="not-found">
		<section class="error-404 not-found">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wordpressify' ); ?></h1>
			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'wordpressify' ); ?></p>

				<?php get_search_form(); ?>
			</div>
		</section>
	</div>
</div>
<!-- /container -->
<?php get_footer(); ?>
