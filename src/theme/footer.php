<<<<<<< HEAD
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
					</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

=======
<footer class="p-4 lg:p-10 footer border-t border-gray-200">
	<div class="footer-inner">
		<div class="text-row">
			<p class="font-medium">
				<?php bloginfo('name'); ?>
			</p>
			<p class="text-gray-400">
				Copyright <?php echo date('Y'); ?> &copy; All rights reserved
			</p>
		</div>
	</div>
</footer>
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
<?php wp_footer(); ?>

</body>
</html> 
