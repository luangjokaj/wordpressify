<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<h1>Header</h1>
</header>
<?php edit_post_link( 'Edit', '<p class="edit-button">', '</p>' ); ?>
