<?php
/**
 * draft Theme Customizer
 *
 * @package draft
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function draft_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'draft_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'draft_customize_partial_blogdescription',
			)
		);
		// Theme Options Panel
$wp_customize->add_panel( 'draft_theme_options', 
array(
	//'priority'       => 100,
	'title'            => __( 'Theme Options', 'draft' ),
	'description'      => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'draft' ),
) 
);
	
	// Text Options Section Inside Theme
$wp_customize->add_section( 'draft_text_options', 
array(
	'title'         => __( 'Text Options', 'draft' ),
	'priority'      => 1,
	'panel'         => 'draft_theme_options'
) 
);
// Setting for Copyright text.
$wp_customize->add_setting( 'draft_copyright_text',
    array(
        'default'           => __( 'All rights reserved ', 'draft' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    )
);
// Control for Copyright text
$wp_customize->add_control( 'draft_copyright_text', 
    array(
        'type'        => 'text',
        'priority'    => 10,
        'section'     => 'draft_text_options',
        'label'       => 'Copyright text',
        'description' => 'Text put here will be outputted in the footer',
    ) 
);

	}
}
add_action( 'customize_register', 'draft_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function draft_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function draft_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function draft_customize_preview_js() {
	wp_enqueue_script( 'draft-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'draft_customize_preview_js' );
