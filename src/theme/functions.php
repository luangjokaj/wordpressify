<?php
/**
 * WordPressify
 */

if ( ! function_exists('is_product')) {
	function is_product() {
		return false;
	}
}

if ( ! function_exists('is_product_category')) {
	function is_product_category() {
		return false;
	}
}

if ( ! function_exists('is_shop')) {
	function is_shop() {
		return false;
	}
}

if ( ! function_exists( 'wordpressify_theme_support' ) ) :
	function wordpressify_theme_support() {
		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );
		// Enqueue editor styles.
		add_editor_style( 'style.css' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 512,
			'gallery_thumbnail_image_width' => 512,
			'single_image_width' => 512,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wordpressify_theme_support' );

if ( ! function_exists( 'wordpressify_theme_styles' ) ) :
	function wordpressify_theme_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'wordpressify_theme-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);
		// Enqueue theme stylesheet.
		wp_enqueue_style( 'wordpressify_theme-style' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'wordpressify_theme_styles' );

define('ALLOW_UNFILTERED_UPLOADS', true);

function custom_mime_types( $mimes ) {
	// New allowed mime types.
	$mimes['svg']  = 'image/svg+xml';
	// Optional. Remove a mime type.
	unset( $mimes['exe'] );
	return $mimes;
}
add_filter( 'upload_mimes', 'custom_mime_types' );

function wordpressify_custom_fav_icon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'. get_template_directory_uri() .'/img/favicon.ico" />';
}
add_action('wp_head', 'wordpressify_custom_fav_icon');

function wordpressify_custom_map() {
	echo '<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({key: "REPLACE-WITH-KEY", v: "weekly"});</script>';
}
add_action('wp_head', 'wordpressify_custom_map');

function wordpressify_enqueue_scripts() {
	wp_enqueue_script( 'header-script', get_template_directory_uri() . '/js/header-bundle.js', array(), true );
	wp_enqueue_script( 'footer-script', get_template_directory_uri() . '/js/footer-bundle.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'wordpressify_enqueue_scripts' );

add_filter( 'woocommerce_breadcrumb_defaults', 'wordpressify_breadcrumb_delimiter' );
function wordpressify_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = ' <em class="divider"></em> ';
	return $defaults;
}

add_filter( 'woocommerce_output_related_products_args', 'wordpressify_change_number_related_products', 99999 );
function wordpressify_change_number_related_products( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

add_filter( 'woocommerce_account_menu_items', 'wordpressify_my_account_menu_items' );
function wordpressify_my_account_menu_items( $items ) {
	unset($items['downloads']);
	unset( $items[ 'dashboard' ] );
	return $items;
}

add_action( 'template_redirect', 'wordpressify__redirect_to_orders_from_dashboard' );
function wordpressify__redirect_to_orders_from_dashboard() {
	if( class_exists( 'WooCommerce' ) && is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
		exit;
	}
}

add_filter('pre_get_document_title', 'wordpressify_change_404_title', 50);
function wordpressify_change_404_title($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$title = 'Web Shop' . " - " . get_bloginfo( 'name' );
	} elseif ( is_404() ) {
		$title = '404 Error' . " - " . get_bloginfo( 'name' );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false ) . " - " . get_bloginfo( 'name' );
	} elseif ( is_search() ) {
		$title = "Search results for " . get_search_query() . " - " . get_bloginfo( 'name' );
	}
	return $title;
}

function wordpressify_doctype_opengraph($output) {
	return $output . '
xmlns:og="http://opengraphprotocol.org/schema/"
xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'wordpressify_doctype_opengraph');

function wordpressify_opengraph() {
	global $post;
	if (is_home() && is_front_page())
	{
		?>
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?= get_bloginfo('name') . " - " . get_bloginfo('description') ?>"/>
		<meta property="og:url" content="<?= get_site_url() ?>"/>
		<meta property="og:image" content="<?= get_template_directory_uri() . '/img/preview.jpg' ?>"/>
		<?php
	}
	else if (is_single() && !is_product())
	{
		if (has_post_thumbnail($post->ID))
		{
			$img_src = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'medium');
		}
		//if featured image not present
		else
		{
			$img_src = get_template_directory_uri() . '/img/preview.jpg';
		}
		?>
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?= get_the_title($post->ID); ?>"/>
		<meta property="og:url" content="<?= get_the_permalink($post->ID); ?>"/>
		<meta property="og:image" content="<?= $img_src; ?>"/>
		<?php
	}
	elseif (is_product())
	{
		$img_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'woocommerce_single_image_width');
		?>
		<meta property="og:type" content="product" />
		<meta property="og:title" content="<?= get_the_title($post->ID) . " - " . get_bloginfo('name'); ?>"/>
		<meta property="og:url" content="<?= get_the_permalink($post->ID); ?>" />
		<meta property="og:image" content="<?= $img_url[0]; ?>"/>
		<?php
	}
	else if (is_product_category())
	{
		$term = get_queried_object();
		$img_src = wp_get_attachment_url(get_term_meta($term->term_id, 'thumbnail_id', true));
		if (empty($img_src))
		{
			$img_src = get_template_directory_uri() . '/img/preview.jpg';
		}
		?>
		<meta property="og:type" content="object" />
		<meta property="og:title" content="<?= $term->name . " - " . get_bloginfo('name'); ?>" />
		<meta property="og:url" content="<?= get_term_link($term->term_id, 'product_cat'); ?>" />
		<meta property="og:image" content="<?= $img_src; ?>" />
		<?php
	}
	elseif (is_shop())
	{
		?>
		<meta property="og:title" content="<?= $term->name . " - " . get_bloginfo('name'); ?>" />
		<meta property="og:url" content="<?= get_permalink(woocommerce_get_page_id('shop')); ?>" />
		<meta property="og:image" content="<?= get_template_directory_uri(); ?>/img/preview.jpg" />
		<?php
	}
	else
	{
		return;
	}
}

add_action('wp_head', 'wordpressify_opengraph', 5);

/* add_filter( 'login_url', 'wordpressify_custom_login_page', 10, 3 );
function wordpressify_custom_login_page( $login_url, $redirect, $force_reauth ) {
	return home_url( '/account/?redirect_to=' . $redirect );
}	*/

add_action( 'wp', 'wordpressify_disable_wc_zoom', 99 );
function wordpressify_disable_wc_zoom() {
	remove_theme_support( 'wc-product-gallery-zoom' );
}

