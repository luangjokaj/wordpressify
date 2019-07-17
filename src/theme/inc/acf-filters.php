<?php

// simple function for dealing with text fields
// removes special characters for html attributes
function a_starting_point_clean_acf_text_fields($string) {
  // sanitize the text before anything
  $string = sanitize_text_field( $string );
  //replace any remaining special characters with white space (except for - and _)
  $string = preg_replace('/[^A-Za-z0-9\-_]/', ' ', $string);
  return $string;
}

// Add the custom classes to widgets (and blocks too I guess)
function a_starting_point_acf_widget_custom_class( $params ) {
	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	// get acf value
	$a_starting_point_custom_css_class_value = a_starting_point_clean_acf_text_fields(get_field('a_starting_point_custom_widget_class', 'widget_' . $widget_id));

	if( $a_starting_point_custom_css_class_value ) {
		$params[0]['before_widget'] = str_replace( 'a-starting-point-acf', esc_html( $a_starting_point_custom_css_class_value ), $params[0]['before_widget'] );
	}
	// return
	return $params;
}
add_filter('dynamic_sidebar_params', 'a_starting_point_acf_widget_custom_class');

// add custom field value to menu class if it exists

function a_starting_point_wp_nav_menu_objects( $items, $args ) {

	$menu = $args->menu;

	$a_starting_point_custom_menu_class = get_field('a_starting_point_custom_menu_class', $menu);

	if($a_starting_point_custom_menu_class){
			$args->menu_class .= ' '. a_starting_point_clean_acf_text_fields($a_starting_point_custom_menu_class);
	}

	return $items;
}
add_filter('wp_nav_menu_objects', 'a_starting_point_wp_nav_menu_objects', 10, 2);
