<?php


// add acf-json path
add_filter('acf/settings/save_json', 'a_starting_point_acf_json_save_point');

function a_starting_point_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/acf-json';

    // return
    return $path;

}

add_filter('acf/settings/load_json', 'a_starting_point_json_load_point');

function a_starting_point_json_load_point( $paths ) {

    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $paths;

}
