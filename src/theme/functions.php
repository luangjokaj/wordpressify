<?php

function lk_theme_resources()
{

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
}

add_action('wp_enqueue_scripts', 'lk_theme_resources');

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
function lk_theme_setup()
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

add_action('after_setup_theme', 'lk_theme_setup');

// Add Widget Areas
function ourWidgetsInit()
{

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
function lk_theme_customize_register($wp_customize)
{

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
		'title' => __('Standard Colors', 'LK_WordPress_Theme'),
		'priority' => 30,
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_link_color_control', array(
		'label' => __('Link Color', 'LK_WordPress_Theme'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_btn_color_control', array(
		'label' => __('Button Color', 'LK_WordPress_Theme'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_btn_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpb_btn_hover_color_control', array(
		'label' => __('Button Hover Color', 'LK_WordPress_Theme'),
		'section' => 'wpb_standard_colors',
		'settings' => 'wpb_btn_hover_color',
	) ) );
}

add_action('customize_register', 'lk_theme_customize_register');

// Output Customize CSS
function lk_theme_customize_css()
{
	?>

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

add_action('wp_head', 'lk_theme_customize_css');

// Custom Logo
function lk_theme_custom_logo($wp_customize)
{
	$wp_customize->add_section('lk-header-logo-section', array(
		'title' => 'Logo',
		'priority' => 20,
	));

	$wp_customize->add_setting('lk-header-logo-image');

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'wpb-footer-callout-image-control', array(
			'label' => 'Image',
			'section' => 'lk-header-logo-section',
			'settings' => 'lk-header-logo-image',
			'width' => 284,
			'height' => 100
		)));
}

add_action('customize_register', 'lk_theme_custom_logo' );

//Add socials
function lk_theme_customize_socials($wp_customize)
{

	$wp_customize->add_setting('instagram', array(
		'default' => 'https://www.instagram.com/lifes.kool/',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('dribbble', array(
		'default' => 'https://dribbble.com/luangjokaj',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('behance', array(
		'default' => 'https://www.behance.net/luangjokaj',
		'transport' => 'refresh',
	));

	$wp_customize->add_section('lk-footer-socials-section', array(
		'title' => __('Socials', 'lk-wordpress-theme'),
		'priority' => 40,
	));
	
	$wp_customize->add_control(
	'lk-intagram-control', array(
		'label'    => 'Instagram',
		'section'  => 'lk-footer-socials-section',
		'settings' => 'instagram',
		'type'     => 'type',
	));

	$wp_customize->add_control(
	'lk-dribble-control', array(
		'label'    => 'Dribbble',
		'section'  => 'lk-footer-socials-section',
		'settings' => 'dribbble',
		'type'     => 'type',
	));

	$wp_customize->add_control(
	'lk-behance-control', array(
		'label'    => 'Behance',
		'section'  => 'lk-footer-socials-section',
		'settings' => 'behance',
		'type'     => 'type',
	));
}

add_action('customize_register', 'lk_theme_customize_socials');

// Output socials
function lk_theme_output_socials()
{
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

// Change PayPal Logo
function paypal_checkout_icon()
{
	return get_stylesheet_directory_uri() .'/img/paypal.svg';
}

add_filter( 'woocommerce_paypal_icon', 'paypal_checkout_icon' );

// Remove Downloads from WooCommerce
// TODO: @Luan Downloads currently DISABLED
function CM_woocommerce_account_menu_items_callback($items)
{
	unset( $items['downloads'] );
	return $items;
}
add_filter('woocommerce_account_menu_items', 'CM_woocommerce_account_menu_items_callback', 10, 1);

show_admin_bar(false);

// Checks if there are any posts in the results
function is_search_has_results() {
	return 0 != $GLOBALS['wp_query']->found_posts;
}