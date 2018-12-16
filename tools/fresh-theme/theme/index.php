<?php get_header(); ?>
<!-- container -->
<div class="container">	
	<!-- site-content -->
	<div class="site-content">

		<!-- main-column -->
		<div class="main-column grid">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				?>
		</div>
		<!-- /main-column -->

		<?php
		else :
			get_template_part( 'content', 'none' );
		endif;
		?>

		<div class="pagination side">
			<?php echo paginate_links(); ?>
		</div> 
	</div>
	<!-- /site-content -->

	<?php get_sidebar(); ?>
</div>
<!-- /container -->

<?php get_footer(); ?>
