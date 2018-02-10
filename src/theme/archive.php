<?php get_header(); ?>

<!-- container -->
<div class="container">	
	<!-- site-content -->
	<div class="site-content">
		<?php if ( have_posts() ) : ?>
		<h1 class="page-title">
		<?php
		if ( is_category() ) {
				single_cat_title();
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_author() ) {
			the_post();
			echo 'Author Archives: ' . get_the_author();
			rewind_posts();
		} elseif ( is_day() ) {
			echo 'Daily Archives: ' . get_the_date();
		} elseif ( is_month() ) {
			echo 'Monthly Archives: ' . get_the_date( 'F Y' );
		} elseif ( is_year() ) {
			echo 'Yearly Archives: ' . get_the_date( 'Y' );
		} else {
			echo 'Archives:';
		}
			?>
		</h1>

		<!-- main-column -->
		<div class="main-column grid 
		<?php
		if ( ! is_search_has_results() ) {
			echo 'no-result'; }
?>
">
			<?php
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
