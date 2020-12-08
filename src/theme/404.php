<?php get_header(); ?>
<div class="pt-5 pb-2 px-5 lg:p-10">	
	<div class="site-content page">
		<article class="page">
			<h1 class="page-title text-xl font-medium"><?php _e('Oops! 404', 'wordpressify'); ?></h1>
			<div class="page-content">
				<p class="block mb-4">
					<?php _e('It looks like nothing was found at this location. Maybe try a search?', 'wordpressify'); ?>
				</p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</div>
</div>
<?php get_footer(); ?>
