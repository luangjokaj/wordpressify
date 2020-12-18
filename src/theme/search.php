<<<<<<< HEAD
<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package a_starting_point
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'a-starting-point' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
=======
<?php get_header();
	$className = '';
	if (!is_search_has_results()) {
		$className = 'no-result';
	}
?>
<div class="lg:grid grid-cols-3 gap-4">	
	<div class="site-content col-span-2 lg:border-r lg:border-gray-200">
		<h2 class="page-title p-4 lg:p-10 text-5xl border-b font-bold border-gray-200">
			Results
		</h2>
		<div class="inner <?php echo $className ?> p-4 lg:p-10">
			<?php
				if (have_posts()) :
					while (have_posts()) :
						the_post();
						get_template_part('content', get_post_format());
					endwhile;
				else :
					get_template_part('content', 'none');
				endif;
			?>
			<div class="pagination">
				<?php echo paginate_links(); ?>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
