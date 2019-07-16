<?php get_header(); ?>
<!-- container -->
<div class="container">	
	<!-- site-content -->
	<div class="site-content">
		<article class="page">
			<!-- main-column -->
			<div class="inner">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'content', get_post_format() );
					endwhile;
					else :
						get_template_part( 'content', 'none' );
					endif;
				?>
			</div>
			<!-- /main-column -->
			<div class="pagination side">
				<?php echo paginate_links(); ?>
			</div>
		</article>
	</div>
	<!-- /site-content -->

	<?php get_sidebar(); ?>
</div>
<!-- /container -->
<?php get_footer(); ?>
