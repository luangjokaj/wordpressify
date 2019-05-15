<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ASP_Theme
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
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'asp-theme' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'asp-theme' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s available on %2$s.', 'asp-theme' ), 'asp-theme', '<a href="https://github.com/cresencio/asp-theme">GitHub</a>' );
							?>
					</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 
