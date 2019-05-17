<?php


// add acf-json path
add_filter('acf/settings/save_json', 'asp_theme_acf_json_save_point');

function asp_theme_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/acf-json';

    // return
    return $path;

}

add_filter('acf/settings/load_json', 'asp_theme_json_load_point');

function asp_theme_json_load_point( $paths ) {

    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $paths;

}
