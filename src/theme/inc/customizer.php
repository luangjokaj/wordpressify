<?php
/**
 * A Starting Point Customizer
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

	$wp_customize->add_setting( 'a_starting_point_main_content_background_color' , array(
		'default'     => 'FFFFFF',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'a_starting_point_main_content_background_color', array(
		'label' => __( 'Main Content Background Color', 'a-starting-point' ),
		'section'    => 'colors',
		'settings'   => 'a_starting_point_main_content_background_color',
	)));

	// add a section, this will not show in the panel until a control is added to it.
	$wp_customize->add_section( 'a_starting_point_content_max_width' , array(
		'title' => __( 'Website Layout', 'a-starting-point' ),
		'priority'   => 30
	));

	// settings go into controls, so set this up before the control
	$wp_customize->add_setting( 'content_max_width' , array(
		'default'     				=> 'none',
		'transport'   				=> 'refresh',
		'type'			  		=> 'theme_mod',
		'sanitize_callback' => 'absint'
		));

	// create the control
	$wp_customize->add_control(
		'content_max_width',
			array(
				'label'       => __( 'Content Max Width', 'a-starting-point' ),
				'section'     => 'a_starting_point_content_max_width',
				'settings'    => 'content_max_width',
				'type'        => 'number',
				'description' => __( 'Modifies the max width of the website\'s content.', 'a-starting-point' ),
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
	wp_enqueue_script( 'a-starting-point-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'a_starting_point_customize_preview_js' );

// hook the styles onto the head

add_action( 'wp_head', 'a_starting_point_customizer_css');
function a_starting_point_customizer_css(){
		?>
		<style type="text/css">
			#page { 
				background-color: <?php echo esc_html(get_theme_mod('a_starting_point_main_content_background_color', '#FFFFFF')); ?>; 
				max-width: <?php echo esc_html( get_theme_mod('content_max_width','960') ).'px'; ?>;
			}
				
		</style>


		<?php
}