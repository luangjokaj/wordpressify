<?php
/**
 * WordPressify
 */

if (! function_exists('wordpressify_theme_support')) :
  function wordpressify_theme_support() {
    load_theme_textdomain('wordpressify', get_template_directory() . '/languages');
    add_editor_style('style.css');
    add_theme_support('woocommerce', [
      'thumbnail_image_width' => 512,
      'gallery_thumbnail_image_width' => 512,
      'single_image_width' => 512,
    ]);
  }
endif;
add_action('after_setup_theme', 'wordpressify_theme_support');

if (! function_exists('wordpressify_theme_styles')) :
  function wordpressify_theme_styles() {
    $theme_version = wp_get_theme()->get('Version');
    $version_string = is_string($theme_version) ? $theme_version : false;
    wp_register_style(
      'wordpressify-style',
      get_template_directory_uri() . '/style.css',
      [],
      $version_string
    );
    wp_enqueue_style('wordpressify-style');
  }
endif;
add_action('wp_enqueue_scripts', 'wordpressify_theme_styles');

function wordpressify_enqueue_scripts() {
  $theme_version = wp_get_theme()->get('Version');
  $version_string = is_string($theme_version) ? $theme_version : false;
  wp_enqueue_script('wordpressify-header', get_template_directory_uri() . '/js/header-bundle.js', [], $version_string, ['in_footer' => false]);
  wp_enqueue_script('wordpressify-footer', get_template_directory_uri() . '/js/footer-bundle.js', [], $version_string, ['in_footer' => true]);
}
add_action('wp_enqueue_scripts', 'wordpressify_enqueue_scripts');

