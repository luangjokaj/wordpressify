<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110577987-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-110577987-1');
	</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<div class="inner-content">
		<a href="<?php echo home_url(); ?>" class="logo">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo 🌈">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo-bright.svg" alt="Logo 🌈" class="bright">
		</a>

		<nav class="navigation">
			<a href="https://github.com/luangjokaj/wordpressify" target="_blank" class="github">
				<img src="<?php echo get_template_directory_uri(); ?>/img/github.svg" alt="GitHub 🝓">
				<img src="<?php echo get_template_directory_uri(); ?>/img/github-bright.svg" alt="GitHub 🝓" class="bright">
			</a>
		</nav>
	</div>
</header>
<?php edit_post_link( 'Edit', '<p class="edit-button">', '</p>' ); ?>
