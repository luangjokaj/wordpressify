<?php get_header(); ?>
	<!-- site-content -->
	<div class="site-content no-margins">
		<!-- gird -->
		<div class="grid">
			<?php if (have_posts()) :
				while (have_posts()) :
					the_post();
					get_template_part('content', get_post_format());
				endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif; ?>
		</div>
		<!-- /grid -->

		<div class="pagination">
			<?php echo paginate_links(); ?>
		</div>

	</div
	><!-- /site-content -->
<?php get_footer(); ?>