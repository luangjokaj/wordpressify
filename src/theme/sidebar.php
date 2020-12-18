<<<<<<< HEAD
<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a_starting_point
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="row">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
=======
<div class="side-column px-4 pb-4 lg:p-10">
	<?php if (is_active_sidebar('sidebar1')) : ?>
		<?php dynamic_sidebar('sidebar1'); ?>
	<?php endif; ?>
</div>
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
