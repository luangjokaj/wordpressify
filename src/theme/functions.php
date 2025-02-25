<?php
/**
 * WordPressify
 */

if (! function_exists('wordpressify_theme_support')) :
  function wordpressify_theme_support() {
    add_theme_support('wp-block-styles');
    add_editor_style('style.css');
    add_theme_support('align-wide');
    add_theme_support('woocommerce');
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
      'wordpressify_theme-style',
      get_template_directory_uri() . '/style.css',
      [],
      $version_string
    );
    wp_enqueue_style('wordpressify_theme-style');
  }
endif;
add_action('wp_enqueue_scripts', 'wordpressify_theme_styles');



function wordpressify_enqueue_scripts() {
  wp_enqueue_script('header-script', get_template_directory_uri() . '/js/header-bundle.js', [], true);
  wp_enqueue_script('footer-script', get_template_directory_uri() . '/js/footer-bundle.js', [], true);
}
add_action('wp_enqueue_scripts', 'wordpressify_enqueue_scripts');

