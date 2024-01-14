<?php
/**
 * draft functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package draft
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function draft_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on draft, use a find and replace
		* to change 'draft' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'draft', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	
// Add Featured Image support
add_theme_support( 'post-thumbnails' );

// Add image sizes

add_image_size( 'dosth-blog-thumbnail', 260, 175, array('center', 'top' ) );






	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'draft' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'draft_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'draft_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function draft_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'draft_content_width', 640 );
}
add_action( 'after_setup_theme', 'draft_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function draft_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'draft' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'draft' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'draft_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

 wp_enqueue_style(       
	'ubuntu-font',  
	'<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">',  
	array(),        
	false
);



function draft_scripts() {
	wp_enqueue_style( 'draft-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'draft-style', 'rtl', 'replace' );

	wp_enqueue_script( 'draft-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'draft_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Enqueue Bootstrap in the theme.
 *
 * This function is responsible for enqueueing the Bootstrap library in the WordPress theme. It includes both the CSS
 * and JavaScript files needed for Bootstrap to enhance the design and functionality of the theme.
 */

 function enqueue_bootstrap() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Enqueue Bootstrap JavaScript dependencies
    wp_enqueue_script('bootstrap-js', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array('jquery'), '3.5.1', true);
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array('jquery'), '2.10.2', true);

    // Enqueue Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

// Include the custom WordPress Bootstrap Navwalker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

/**
 * Add the Custom Field Function for Post Views.
 *
 * This function updates the post views count every time a single post is viewed.
 */
function update_post_views($post_id) {
    $views = get_post_meta($post_id, 'post_views', true);
    $views = ($views) ? $views + 1 : 1;
    update_post_meta($post_id, 'post_views', $views);
}

/**
 * Hook the Function to Track Post Views.
 *
 * This function is hooked to the 'wp_head' action and tracks post views if the current page is a single post.
 */
function track_post_views() {
    if (is_single()) {
        global $post;
        update_post_views($post->ID);
    }
}
add_action('wp_footer', 'track_post_views');
/**
 * Enqueue custom stylesheet for post navigation.
 *
 * This function enqueues a custom stylesheet for post navigation with the 'custom-styles' handle.
 */

/**
 * Register Footer Menu.
 *
 * This function registers the 'footer' menu location in WordPress, allowing for a custom footer menu.
 */
function register_footer_menu() {
    register_nav_menu('footer', __('Footer Menu', 'your-theme-textdomain'));
}
add_action('init', 'register_footer_menu');

/**
 * Register widget area.
 *
 * This function registers two widget areas for the footer section, 'Footer Section One' and 'Footer Section Two'.
 */
function nd_dosth_register_sidebars() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Section One', 'nd_dosth' ),
        'id'            => 'footer-section-one',
        'description'   => esc_html__( 'Widgets added here would appear inside the first section of the footer', 'nd_dosth' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Section Two', 'nd_dosth' ),
        'id'            => 'footer-section-two',
        'description'   => esc_html__( 'Widgets added here would appear inside the second section of the footer', 'nd_dosth' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'nd_dosth_register_sidebars' );




/*
 * Custom Excerpt Length
 */  

 function custom_excerpt($limit) {
	return wp_trim_words(get_the_excerpt(), $limit, '...');
 }
 function custom_excerpt_length( $length ) {
   return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
