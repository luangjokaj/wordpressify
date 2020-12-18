<<<<<<< HEAD
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package a_starting_point
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
=======
<?php get_header(); ?>
<div class="p-4 lg:p-10">	
	<div class="site-content single">
		<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post();
				if (get_post_format() == false) {
					get_template_part('content', 'single');
				} else {
					get_template_part('content', get_post_format());
				}
		endwhile;
		else :
			get_template_part('content', 'none');
		endif;
		?>
	</div>
</div>
<?php get_footer(); ?>
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
