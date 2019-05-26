<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a_starting_point
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
<div id="page" class="site">

	<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'a-starting-point' ); ?></a>

	<header id="masthead" class="site-header">

		<?php get_sidebar('header'); ?>

		<div class="container-fluid">
			<div class="row">

					<div class="site-branding">
						<?php

						the_custom_logo();

						if ( is_front_page() && is_home() ) : ?>

							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

							<?php
						else : ?>

							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

							<?php
						endif;

						$a_starting_point_description = get_bloginfo( 'description', 'display' );

						if ( $a_starting_point_description || is_customize_preview() ) : ?>

<p class="site-description"><?php echo $a_starting_point_description; /* WPCS: xss ok. */ ?></p>

						<?php endif; ?>

					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">

						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'menu', 'a-starting-point' ); ?></button>
						<?php

						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );

						?>

					</nav><!-- #site-navigation -->

					<?php the_header_image_tag(); ?>

			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container-fluid">
			<div class="row">
