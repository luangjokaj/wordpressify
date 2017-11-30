<?php

function wordpressify_resources()
{

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
}

add_action('wp_enqueue_scripts', 'wordpressify_resources');

// Get top ancestor
function get_top_ancestor_id()
{

	global $post;

	if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];
	}

	return $post->ID;
}

// Does page have children?
function has_children()
{

	global $post;

	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);
}

// Customize excerpt word count length
function custom_excerpt_length()
{
	return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function wordpressify_setup()
{

	// Navigation Menus
	register_nav_menus(array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu'),
	));

	// Handle Titles
	add_theme_support( 'title-tag' );

	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 720, 720, true);
	add_image_size('square-thumbnail', 80, 80, true);
	add_image_size('banner-image', 1024, 1024, true);

	// Add post type support
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));

	// Add WooCommerce support
	add_action( 'after_setup_theme', 'woocommerce_support' );
	add_theme_support( 'woocommerce' );
}

add_action('after_setup_theme', 'wordpressify_setup');

// Add Widget Areas
function wordpressify_widgets() {
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

add_action('widgets_init', 'wordpressify_widgets');

// Custom Logo
function wordpressify_custom_logo($wp_customize) {
	$wp_customize->add_section('wordpressify-logo-section', array(
		'title' => 'Logo',
		'priority' => 20,
	));

	$wp_customize->add_setting('wordpressify-header-logo-image');

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'wordpressify-footer-callout-image-control', array(
			'label' => 'Image',
			'section' => 'wordpressify-logo-section',
			'settings' => 'wordpressify-header-logo-image',
			'width' => 284,
			'height' => 100
		)));
}

add_action('customize_register', 'wordpressify_custom_logo' );

//Add socials
function wordpressify_customize_socials($wp_customize) {
	$wp_customize->add_setting('instagram', array(
		'default' => 'https://www.instagram.com/',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('dribbble', array(
		'default' => 'https://dribbble.com/',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('behance', array(
		'default' => 'https://www.behance.net/',
		'transport' => 'refresh',
	));

	$wp_customize->add_section('wordpressify-footer-socials-section', array(
		'title' => __('Socials', 'lk-wordpress-theme'),
		'priority' => 40,
	));
	
	$wp_customize->add_control(
	'lk-intagram-control', array(
		'label'    => 'Instagram',
		'section'  => 'wordpressify-footer-socials-section',
		'settings' => 'instagram',
		'type'     => 'type',
	));

	$wp_customize->add_control(
	'lk-dribble-control', array(
		'label'    => 'Dribbble',
		'section'  => 'wordpressify-footer-socials-section',
		'settings' => 'dribbble',
		'type'     => 'type',
	));

	$wp_customize->add_control(
	'lk-behance-control', array(
		'label'    => 'Behance',
		'section'  => 'wordpressify-footer-socials-section',
		'settings' => 'behance',
		'type'     => 'type',
	));
}

add_action('customize_register', 'wordpressify_customize_socials');

// Output socials
function wordpressify_output_socials() {
	// return get_theme_mod('instagram');
	?>
	<ul>
		<li>
			<a href="<?php echo  get_theme_mod('instagram');?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/instagram.svg" alt="Instagram">
			</a>
		</li>
		<li>
			<a href="<?php echo  get_theme_mod('dribbble');?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/dribbble.svg" alt="Dribbble">
			</a>
		</li>
		<li>
			<a href="<?php echo  get_theme_mod('behance');?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/behance.svg" alt="Behance">
			</a>
		</li>
	</ul>
	<?php
}

show_admin_bar(false);

// Checks if there are any posts in the results
function is_search_has_results() {
	return 0 != $GLOBALS['wp_query']->found_posts;
}