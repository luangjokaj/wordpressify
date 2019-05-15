<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ASP_Theme
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<div id="footer-widgets" class="widget-area">
	<div class="container-fluid">
			<div class="row">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
	</div>
</div><!-- #footer-widgets -->
