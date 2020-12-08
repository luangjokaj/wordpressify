<?php
function wordpressify_resources()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
}

add_action('wp_enqueue_scripts', 'wordpressify_resources');

function custom_excerpt_length()
{
	return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');

function wordpressify_setup()
{
	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 720, 720, true);
	add_image_size('square-thumbnail', 80, 80, true);
	add_image_size('banner-image', 1024, 1024, true);
}

add_action('after_setup_theme', 'wordpressify_setup');

show_admin_bar(false);

function is_search_has_results()
{
	return 0 != $GLOBALS['wp_query']->found_posts;
}

function wordpressify_widgets()
{
	register_sidebar(
		[
			'name' => 'Sidebar',
			'id' => 'sidebar1',
			'before_widget' => '<div class="widget-item">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		]
	);
}

add_action('widgets_init', 'wordpressify_widgets');
