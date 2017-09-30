<?php get_header(); ?>
	<!-- site-content -->
	<div class="site-content no-margins">

		<h2 class="side-title">Search results for: <?php the_search_query(); ?></h2>
		<!-- main-column -->
		<div class="main-column grid <?php if(!is_search_has_results()) { echo 'no-result'; } ?>">
			<?php if (have_posts()) :
			while (have_posts()) :
				the_post();
				get_template_part('content', get_post_format());
			endwhile; ?>
		</div>
		<!-- /main-column -->

		<?php else :
			get_template_part( 'content', 'none' );
		endif; ?>
	
		<div class="pagination side">
			<?php echo paginate_links(); ?>
		</div>
	</div>
	<!-- /site-content -->
	<?php get_sidebar(); ?>


<?php get_footer(); ?>