<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<div class="inner-content">
		<?php if (get_theme_mod('wordpressify-logo-section')) { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo wp_get_attachment_url(get_theme_mod('wordpressify-logo-section')); ?>"
				alt="Logo 🌈">
			</a>
		<?php } else { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo 🌈">
			</a>
		<?php } ?>

		<nav class="navigation">
			<?php $args = array(
				'theme_location' => 'primary'
			); ?>
			<?php wp_nav_menu($args); ?>
			<a href="#" class="github">
				<img src="<?php echo get_template_directory_uri(); ?>/img/github.svg" alt="GitHub 🝓">
			</a>
		</nav>
	</div>
</header>
<!-- container -->
<div class="container">