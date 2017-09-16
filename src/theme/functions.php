<?php

function WP_Build_resources() {

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', NULL, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', NULL, 1.0, true);

}

add_action('wp_enqueue_scripts', 'WP_Build_resources');

// Get top ancestor
function get_top_ancestor_id() {

	global $post;

	if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];

	}

	return $post->ID;

}

// Does page have children?
function has_children() {

	global $post;

	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);

}

// Customize excerpt word count length
function custom_excerpt_length() {
	return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function WP_Build_setup() {

	// Navigation Menus
	register_nav_menus(array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu'),
	));

	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 180, 120, true);
	add_image_size('square-thumbnail', 80, 80, true);
	add_image_size('banner-image', 920, 210, array('left', 'top'));

	// Add post type support
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'WP_Build');

// Add Widget Areas
function ourWidgetsInit() {

	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar( array(
		'name' => 'Footer Area 1',
		'id' => 'footer1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar( array(
		'name' => 'Footer Area 2',
		'id' => 'footer2',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar( array(
		'name' => 'Footer Area 3',
		'id' => 'footer3',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar( array(
		'name' => 'Footer Area 4',
		'id' => 'footer4',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

}

add_action('widgets_init', 'ourWidgetsInit');


// Customize Appearance Options
function WP_Build_customize_register( $wp_customize ) {

	$wp_customize->add_setting('wpb_link_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('wpb_btn_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('wpb_btn_hover_color', array(
		'default' => '#004C87',
		'transport' => 'refresh',
	));

	$wp_customize->add_section('wpb_standard_colors', array(
		'title' => __('Standard Colors', 'WP_Build'),
		'priority' => 30,
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_link_color_control', array(
		'label' => __('Link Color', 'WP_Build'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_btn_color_control', array(
		'label' => __('Button Color', 'WP_Build'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_btn_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_btn_hover_color_control', array(
		'label' => __('Button Hover Color', 'WP_Build'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_btn_hover_color',
	) ) );

}

add_action('customize_register', 'WP_Build_customize_register');



// Output Customize CSS
function WP_Build_customize_css() { ?>

	<style type="text/css">

		a:link,
		a:visited {
			color: <?php echo get_theme_mod('wpb_link_color'); ?>;
		}

		.site-header nav ul li.current-menu-item a:link,
		.site-header nav ul li.current-menu-item a:visited,
		.site-header nav ul li.current-page-ancestor a:link,
		.site-header nav ul li.current-page-ancestor a:visited {
			background-color: <?php echo get_theme_mod('wpb_link_color'); ?>;
		}

		.btn-a,
		.btn-a:link,
		.btn-a:visited,
		div.hd-search #searchsubmit {
			background-color: <?php echo get_theme_mod('wpb_btn_color'); ?>;
		}

		.btn-a:hover,
		div.hd-search #searchsubmit:hover {
			background-color: <?php echo get_theme_mod('wpb_btn_hover_color'); ?>;
		}

	</style>

<?php }

add_action('wp_head', 'WP_Build_customize_css');

// Custom Logo
function WP_Build_logo($wp_customize) {
	$wp_customize->add_section('WP_Build_header_logo_section', array(
		'title' => 'Logo'
	));

	$wp_customize->add_setting('WP_Build_header_logo_image');

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'lwp-footer-callout-image-control', array(
			'label' => 'Image',
			'section' => 'WP_Build_header_logo_section',
			'settings' => 'WP_Build_header_logo_image',
			'width' => 1119,
			'height' => 93
		)));
}

add_action('customize_register', 'WP_Build_logo' );