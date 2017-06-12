<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name'); ?></title>
	<script src="<?php echo get_template_directory_uri() ?>/header-bundle.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>

		<!-- hd-search -->
		<div class="search">
	        <?php get_search_form(); ?>
		</div><!-- /hd-search -->
	    <?php if (get_theme_mod('gg-header-logo-image')) { ?>
		    <a href="<?php echo home_url(); ?>">
				<img src="<?php echo wp_get_attachment_url(get_theme_mod('gg-header-logo-image')); ?>">
		    </a>
	    <?php } else { ?>
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<h5><?php bloginfo('description'); ?> <?php if (is_page('portfolio')) { ?>
					- Thank you for viewing our work
			<?php } ?></h5>
		<?php } ?>

		<nav>

	        <?php

	        $args = array(
	            'theme_location' => 'primary'
	        );

	        ?>

	        <?php wp_nav_menu($args); ?>
		</nav>

	</header>
	<div class="container">