<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- search -->
<div class="lk-search">
	<?php get_search_form(); ?>
</div>
<!-- search -->
<i class="shadow"></i>
<header id="header" class="lk-header">

	<div class="siteInfo">
		<?php if (get_theme_mod('lk-header-logo-section')) { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo wp_get_attachment_url(get_theme_mod('lk-header-logo-section')); ?>"
				alt="Logo 🌈">
			</a>
		<?php } else { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo 🌈">
			</a>
		<?php } ?>

		<nav>
			<button id="menu"><span></span></button>
			<?php $args = array(
				'theme_location' => 'primary'
			); ?>
			<?php wp_nav_menu($args); ?>
		</nav>

		<button id="search"></button>
		<button id="close-search"><span></span></button>
	</div>

</header>
<!-- container -->
<div class="container">