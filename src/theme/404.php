<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package a_starting_point
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'a-starting-point' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'a-starting-point' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<aside id="secondary" class="widget-area">
		<div class="row">
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'a-starting-point' ); ?></h2>
				<ul>
					<?php
					wp_list_categories( 
						array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) 
					);
					?>
				</ul>
			</div><!-- .widget -->
		    <?php
			/* translators: %1$s: smiley */
			$a_starting_point_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'a-starting-point' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$a_starting_point_archive_content" );

			the_widget( 'WP_Widget_Tag_Cloud' );
			?>
		</div>
	</aside><!-- #secondary -->

<?php
get_footer();
