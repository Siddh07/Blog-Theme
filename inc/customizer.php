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
add_action( 'customize_register', 'draft_customize_register' );
function draft_customize_register( $wp_customize ) {
    // All the Customize Options you create goes here
    // Move Homepage Settings section underneath the "Site Identity" section
    $wp_customize->get_section('title_tagline')->priority = 1;
    $wp_customize->get_section('static_front_page')->priority = 2;
    $wp_customize->get_section('static_front_page')->title = __( 'Home page preferences', 'draft' );
  
	
	

	// Setting for Read More text.
$wp_customize->add_setting( 'draft_readmore_text',
array(
	'type'              => 'option',
	'default'           => __( 'Read More ', 'draft' ),
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'refresh',
)
);
// Control for Read More text
$wp_customize->add_control( 'draft_readmore_text', 
array(
	'type'        => 'text',
	'priority'    => 10,
	'section'     => 'draft_text_options',
	'label'       => 'Read More text',
	'description' => 'Text put here will be as the text for Read More link in the archives',
    'active_callback' => 'draft_hide_readmore_on_condition'    ) 
);
/**
 * Show "Read More Text" Control only if a condition is met.
 *
 * @param WP_Customize_Manager object
 * @return bool
 */
function draft_hide_readmore_on_condition( $control ) {
    if( is_archive() || is_front_page() || is_home() ){
        return true;
    } else{
        return false;
    }
}
/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either true or false.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function draft_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// Setting to Show/Hide Read More Link.
$wp_customize->add_setting( 'draft_show_readmore',
array(
	'type'              => 'option',
	'default'           => false,
	'sanitize_callback' => 'draft_sanitize_checkbox',
	'transport'         => 'refresh',
)
);

// Control to Show/Hide Read More Link.
$wp_customize->add_control( 'draft_readmore_text', 
array(
	'type'        => 'checkbox',
	'section'     => 'draft_text_options',
	'label'       => 'Show Read More Link',
	'description' => 'Turn off this checkbox to hide Read More Link on Post archives',
) 
);







	
	// Theme Options Panel
    $wp_customize->add_panel( 'draft_theme_options', 
        array(
            //'priority'         => 100,
            'title'            => __( 'Theme Options', 'draft' ),
            'description'      => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'draft' ),
        ) 
    );
    // Text Options Section
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
