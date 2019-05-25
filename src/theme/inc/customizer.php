<?php
/**
 * ASP Theme Theme Customizer
 *
 * @package a_starting_point
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function a_starting_point_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'a_starting_point_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'a_starting_point_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_setting( 'asp_main_content_background_color' , array(
		'default'     => 'FFFFFF',
		'transport'   => 'refresh',
		'sanitize_callback' => 'a_starting_point_sanitize_main_content_background_color'
	));

	//https://developer.wordpress.org/reference/functions/sanitize_hex_color/

	function a_starting_point_sanitize_main_content_background_color($input){
		if ( '' === $input ) {
			return '';
		}
	 
		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $input ) ) {
			return $input;
		}
	}

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_main_content_background_color', array(
		'label'        => 'Main Content Background Color',
		'section'    => 'colors',
		'settings'   => 'asp_main_content_background_color',
	)));

	// add a section, this will not show in the panel until a control is added to it.
	$wp_customize->add_section( 'asp_content_max_width' , array(
		'title'      => 'Site Layout',
		'priority'   => 30
	));

	// settings go into controls, so set this up before the control
	$wp_customize->add_setting( 'content_max_width' , array(
		'default'     				=> 'none',
		'transport'   				=> 'refresh',
		'type'			  		=> 'theme_mod',
		'sanitize_callback' => 'a_starting_point_sanitize_content_max_width'
		));

	function a_starting_point_sanitize_content_max_width( $input, $setting ){
		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);
		//return input if valid or return default option
		return ( intval($input) ? $input.'px' : $setting->default );
	}
	// create the control
	$wp_customize->add_control(
		'content_max_width',
			array(
				'label'       => 'Content Max Width',
				'section'     => 'asp_content_max_width',
				'settings'    => 'content_max_width',
				'type'        => 'number',
				'description' => __( 'Modifies the max width of the website\'s content (pixels).', 'a-starting-point' ),
			)
	);

}
add_action( 'customize_register', 'a_starting_point_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function a_starting_point_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function a_starting_point_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function a_starting_point_customize_preview_js() {
	wp_enqueue_script( 'asp-theme-customizer', get_template_directory_uri() . '/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'a_starting_point_customize_preview_js' );

// hook the styles onto the head

add_action( 'wp_head', 'asp_customizer_css');
function asp_customizer_css(){
		?>
		<style type="text/css">
			#page { 
				background-color: <?php echo get_theme_mod('asp_main_content_background_color', 'FFFFFF'); ?>; 
				max-width: <?php echo get_theme_mod('content_max_width', 'none'); ?>;
			}
				
		</style>


		<?php
}