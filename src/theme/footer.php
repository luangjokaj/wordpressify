<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a_starting_point
 */

?>
			</div> <!-- .row -->
		</div> <!-- .container-fluid -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php get_sidebar('footer'); ?>

		<div class="container-fluid">
			<div class="row">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'a-starting-point' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'a-starting-point' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s available on %2$s.', 'a-starting-point' ), 'A Starting Point', '<a href="https://github.com/cresencio/asp-theme">GitHub</a>' );
							?>
					</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 
