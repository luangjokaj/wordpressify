<?php
/**
 * The sidebar containing the header widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a_starting_point
 */

if ( ! is_active_sidebar( 'sidebar-header' ) ) {
	return;
}
?>

<div id="header-widgets" class="widget-area">
	<div class="container-fluid">
			<div class="row">
				<?php dynamic_sidebar( 'sidebar-header' ); ?>
			</div>
	</div>
</div><!-- #header-widgets -->
