<?php
function wordpressify_resources()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
}
add_action( 'widgets_init', 'a_starting_point_widgets_init' );

<<<<<<< HEAD
/**
 * Enqueue scripts and styles.
 */
function a_starting_point_scripts() {
	
	wp_enqueue_style( 'a_starting_point_style', get_stylesheet_uri() );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.js', null, 1.15, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), null, 4.3, true );
	wp_enqueue_script( 'a_starting_point_navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), null, 1.0, true );
	wp_enqueue_script( 'a_starting_point_skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'a_starting_point_scripts' );

/**
 * Registers an editor stylesheet for the theme.
 */
function a_starting_point_add_editor_styles() {
    add_editor_style();
}
add_action( 'admin_init', 'a_starting_point_add_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if( class_exists('acf') ) {
	/**
	 * Load Advanced Custom Fields plugin
	 */
	require get_template_directory() . '/inc/advanced-custom-fields.php';

	/**
	 * Load Advanced Custom Fields filters
	 */
	require get_template_directory() . '/inc/acf-filters.php';
}

// add the BS nav class to all menus

function a_starting_point_add_bs_nav_class_to_menus( $args )
{
	$args['menu_class'] .= ' nav';
	return $args;
}

add_filter( 'wp_nav_menu_args', 'a_starting_point_add_bs_nav_class_to_menus' );

// add BS nav-item class to all li tags
function a_starting_point_add_bs_link_item_class_to_list_items($classes, $item, $args) {
  $classes[] = 'nav-item';
  return $classes;
=======
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
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
}
add_filter('nav_menu_css_class', 'a_starting_point_add_bs_link_item_class_to_list_items', 1, 3);

<<<<<<< HEAD
// add the BS nav-link class to all menu links
function a_starting_point_add_bs_nav_link_class_to_menu_links($atts) {
  $atts['class'] = "nav-link";
  return $atts;
=======
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
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
}
add_filter( 'nav_menu_link_attributes', 'a_starting_point_add_bs_nav_link_class_to_menu_links');

<<<<<<< HEAD
if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 */
		do_action( 'wp_body_open' );
	}
endif;
=======
add_action('widgets_init', 'wordpressify_widgets');
>>>>>>> dccefe0cdc4e872e807b1e31ef9207d9996d665f
