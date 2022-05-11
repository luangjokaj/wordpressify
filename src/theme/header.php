<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="author" content="Luan Gjokaj, and WordPressify contributors" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php wp_head(); ?>
	<link
		rel="preconnect"
		href="https://fonts.gstatic.com"
		crossOrigin="true"
	/>
	<link
		rel="preload"
		as="style"
		href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
	/>
	<link
		rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
		media="print"
		onLoad="this.media='all'"
	/>
	<noscript>
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
		/>
	</noscript>
	<script async="" src="/browser-sync/browser-sync-client.js"></script>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<div class="container">
		<a href="/">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo 🌈">
		</a>
	</div>
	<?php edit_post_link('Edit', '<p>', '</p>', null, 'edit-button button'); ?>
</header>
