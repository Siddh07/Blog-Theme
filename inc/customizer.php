<?php
/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    Dosth
 */

add_action( 'customize_register', 'draft_customize_register' );
function draft_customize_register( $wp_customize ) {
    // All the Customize Options you create goes here
    

    // Move Homepage Settings section underneath the "Site Identity" section
    $wp_customize->get_section('title_tagline')->priority = 1;
    $wp_customize->get_section('static_front_page')->priority = 2;
    $wp_customize->get_section('static_front_page')->title = __( 'Home page preferences', 'draft' );

    //Enable Live Preview for Default Settings
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

    /* Retina Logo */
    $wp_customize->add_setting( 'tbe_retina_logo', array(
        'type'                  => 'theme_mod',
        'capability'            => 'edit_theme_options',
        //'sanitize_callback'     => 'tbe_sanitize_image_callback',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tbe_retina_logo', array(
            'label' 		   => __('Logo Retina Version','the-basics-of-everything'),
            'section' 		 => 'title_tagline',
            'settings'     => 'tbe_retina_logo',
    ) ) );

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
            'active_callback' => 'draft_hide_readmore_on_condition'
        ) 
    );

    // Setting to Show/Hide Read More Link.
    $wp_customize->add_setting( 'draft_show_readmore',
        array(
            'type'              => 'option',
            'default'           => true,
            'sanitize_callback' => 'draft_sanitize_checkbox',
            'transport'         => 'postMessage',
        )
    );

    // Control to Show/Hide Read More Link.
    $wp_customize->add_control( 'draft_show_readmore', 
        array(
            'type'        => 'checkbox',
            'section'     => 'draft_text_options',
            'label'       => 'Show Read More Link',
            'description' => 'Turn off this checkbox to hide Read More Link on Post archives',
        ) 
    );

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
    
    /**
     * Show "Read More Text" Control only if a condition is met.
     *
     * @param WP_Customize_Manager object
     * @return bool
     */
    function draft_hide_readmore_on_condition( $control ) {
        $setting = $control->manager->get_setting( 'draft_show_readmore' );
        if( ( true == $setting->value() ) and ( is_archive() || is_front_page() || is_home() ) ){
            return true;
        } else{
            return false;
        }
    }

    // Color Options Section
    $wp_customize->add_section( 'draft_color_options', 
        array(
            'title'         => __( 'Color Options', 'draft' ),
            'panel'         => 'draft_theme_options'
        ) 
    );

    // Add a new setting for primary color.
    $wp_customize->add_setting( 'draft_color_primary',
        array(
            'default'              => 'fdb813',
            'type'                 => 'option',
            'sanitize_callback'    => 'sanitize_hex_color_no_hash',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
            'transport'            => 'postMessage',
        )
    );
    // Add a control for primary color.
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'draft_color_primary',
            array(
                'label'    		=> esc_html__( 'Primary Color', 'draft' ),
                'section'  		=> 'draft_color_options',
                'settings' 		=> 'draft_color_primary',
            )
        )
    );

    // Add a new setting for Secondary color.
    $wp_customize->add_setting( 'draft_color_secondary',
        array(
            'default'              => '1a3794',
            'type'                 => 'option',
            'sanitize_callback'    => 'sanitize_hex_color_no_hash',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
            'transport'            => 'postMessage',
        )
    );
    // Add a control for Secondary color.
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'draft_color_secondary',
            array(
                'label'    		=> esc_html__( 'Secondary Color', 'draft' ),
                'section'  		=> 'draft_color_options',
                'settings' 		=> 'draft_color_secondary',
            )
        )
    );
}

/**
 * Register customize panel controls scripts.
 */
function draft_customize_controls_register_scripts() {
	wp_enqueue_script(
		'draft-customize-active-callbacks',
		get_stylesheet_directory_uri() . '/assets/js/customize-active-callback.js',
		array(),
		'',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'draft_customize_controls_register_scripts', 0 );

/**
 * Registers the Theme Customizer Preview with WordPress.
 */
function draft_customize_live_preview() {
	wp_enqueue_script(
		'draft-customize-js',
		get_stylesheet_directory_uri() . '/assets/js/customize.js',
		array( 'jquery', 'customize-preview' ),
		'',
		true
	);
}
add_action( 'customize_preview_init', 'draft_customize_live_preview' );

/**
 * Generate Internal CSS from the values Customize Panel Settings
 */
function draft_customization_css(){

    $style = '';

    //Get Options from the Customize Panel
    $show_read_more_link    = get_option( 'draft_show_readmore' );
    $primary_color_code     = get_option( 'draft_color_primary', 'fdb100' );
    $secondary_color_code   = get_option( 'draft_color_secondary', '1a3794' );


    // Hide ".read-more-link" element if the "Show Read More Link" Control is turned Off
    if( false == $show_read_more_link ){
        $style .= ".read-more-link{display:none}";
    }

    // Primary Color as Background Color
    $style .= '#site-footer .es_button input,
    .slick-dots li.slick-active,
    .menu-button a,
    .page-template-default .content-container .page-title,
    .pagination .nav-links a, .pagination .nav-links .current,
    #commentform input[type="submit"]
                { background-color: #'. $primary_color_code .'; }';

    // Primary Color as Text Color
    $style .= '#announcement .announcement-title,
    .draft-reviews blockquote p,
    .search-results .page-title,
    .menu li:hover > a, .menu li a:focus,
    .current-menu-item a,
    #blog-sidebar .widget .current-cat a,
    .previous-article
                { color:#'. $primary_color_code .'; }';  
    
    // Secondary Color as Background Color
    $style .= '#announcement{ background-color:#'. $secondary_color_code .'; }';  
    
    // Secondary Color as Text Color
    $style .= '.blog .page-title, .archive .page-title,
    .blog-posts .blog-post h2 a:hover, 
    .blog-posts .blog-post h3 a:hover,
    .read-more-link, .posted-in a,
    .widget-title,
    .single .article-info a,
    .comment-reply-link,
    .next-article,
    .single .related-articles h2,
    .search-results .search-query
                { color:#'. $secondary_color_code .'; }';  
                

    // Remove unnecessary spacing from the styles
    $style = str_replace( array( "\r", "\n", "\t" ), '', $style );

    // Put the final style output together.
	$style = "\n" . '<style type="text/css" id="customization-css">' . trim( $style ) . '</style>' . "\n";

    // Echo it
    echo $style;

}
add_action( 'wp_head', 'draft_customization_css' );