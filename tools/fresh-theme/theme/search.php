<?php get_header(); ?>
<!-- container -->
<div class="container">	
	<!-- site-content -->
	<div class="site-content">
		<article class="page">
			<h2 class="page-title">Results</h2>
			<!-- main-column -->
			<div class="inner <?php if ( ! is_search_has_results() ) { echo 'no-result'; }?>">
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
		</div>
	</div>
	<!-- /site-content -->

	<?php get_sidebar(); ?>
</div>
<!-- /container -->
<?php get_footer(); ?>
