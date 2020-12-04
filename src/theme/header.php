<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="author" content="Luan Gjokaj, and WordPressify contributors" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="container header">
	<h1>Header</h1>
	<?php edit_post_link( 'Edit', '<p class="edit-button">', '</p>' ); ?>
</header>
