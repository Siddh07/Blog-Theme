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



function enqueue_font_awesome() {
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', '', '5.8.1', 'all');
 }
 
 add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
 

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

function register_footer_cato_menu() {
    register_nav_menu('footer_cato', __('Footer Cato'));
}
add_action('after_setup_theme', 'register_footer_cato_menu');



function register_footer_widget() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'your-theme-textdomain' ),
        'id'            => 'footer-widget-area',
        'description'   => __( 'Widgets in this area will be shown in the footer.', 'your-theme-textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'register_footer_widget' );



/**
 * Register widget area.
 *
 * This function registers two widget areas for the footer section, 'Footer Section One' and 'Footer Section Two'.
 */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function draft_register_sidebars() {
	
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Section One', 'draft' ),
        'id'            => 'footer-section-one',
        'description'   => esc_html__( 'Widgets added here would appear inside the first section of the footer', 'draft' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
        
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Section Two', 'draft' ),
		'id'            => 'footer-section-two',
		'description'   => esc_html__( 'Widgets added here would appear inside the second section of the footer', 'draft' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Blog', 'draft' ),
        'id'            => 'blog',
        'description'   => esc_html__( 'Widgets added here would appear inside the all the blog pages', 'draft' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

}
add_action( 'widgets_init', 'draft_register_sidebars' );

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



/*
 * Outputs the post's thumbnail and title when ID of the post is provided
 */
function draft_output_post_thumb_and_title( $post_id ){ ?>
    <div class="post-info">
        <?php // Output Post's Thumbnail ?>
        <?php $page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' ); ?>
        <?php if( ! empty( $page_thumb[0] ) ) : ?>
            <a href="<?php echo get_the_permalink( $post_id ); ?>" class="post-thumb">
                <img src="<?php echo $page_thumb[0]; ?>" />
            </a>
        <?php endif; ?>
        <?php // Output Previous page Title ?>
        <a class="post-title" href="<?php echo get_the_permalink( $post_id ); ?>">
            <?php echo get_the_title( $post_id ); ?>
        </a>
    </div>    
<?php }



/**
 * Register Custom Post Types.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 */
// function draft_register_custom_post_types(){
//     //Register Reviews Post Type
//     register_post_type( 'draft_reviews',
//         array(
//             'labels'  => array(
//                 'name'           => __( 'Reviews', 'draft' ),
//                 'singular_name'  => __( 'Review', 'draft' ),
//                 'add_new'        => __( 'Add Review', 'draft' ),
//                 'add_new_item'   => __( 'Add New Review', 'draft' ),
//                 'edit_item'      => __( 'Edit Review', 'draft' ),
//                 'all_items'      => __( 'All Reviews', 'draft' ),
//                 'not_found'      => __( 'No Reviews Found', 'draft' ),
//             ),
//             'menu_icon'             => 'dashicons-format-quote',
//             'public'                => true,
//             'exclude_from_search'   => false,
//             'has_archive'           => true,
//             'hierarchical'          => false,
//             'show_in_rest'          => true,
//             'rewrite'               => array( 'slug' => 'reviews' ),
//             'supports'              => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
//             'taxonomies'            => array( 'category', 'post_tag' )
//         )
//     );
// }
 
// add_action('init', 'draft_register_custom_post_types');



/*
 * Enqueue Scripts
 */
function draft_enqueue_styles() {
 

   
    wp_enqueue_style(       
        'slick',    
        get_stylesheet_directory_uri() . '/assets/css/slick.css',   
        array(),        
        false,      
        'all' 
    );
    wp_enqueue_style(       
        'ubuntu-font',  
        'https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700',  
        array(),        
        false
    );
    wp_enqueue_style(       
        'main-stylesheet',  
        get_stylesheet_uri(),   
        array('normalize', 'bootstrap'),        
        "8.0",      
        'all' 
    );
}
add_action( 'wp_enqueue_scripts', 'draft_enqueue_styles' );




function enqueue_full_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '3.5.1', true);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_full_jquery');


function mytheme_enqueue_scripts() {
    // Enqueue jQuery first
    wp_enqueue_script( 'jquery' );

    // Enqueue Popper.js
   
    // Enqueue Bootstrap JavaScript
    wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery', 'popper'), null, true );

    // Enqueue Infinite Scroll script after jQuery
    wp_enqueue_script('mytheme-infinite-scroll', get_template_directory_uri() . '/js/infinite_scroll.js', array('jquery'), '1.0.0', true);

    // Localize the script with the appropriate data
    wp_localize_script('mytheme-infinite-scroll', 'mytheme_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('mytheme_load_more_posts_nonce')
    ));
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );











function custom_mytheme_enqueue_script() {
    if (is_archive()) {
        wp_enqueue_style('mytheme-archive', get_template_directory_uri() . '/assets/css/archive.css');
        wp_enqueue_script('mytheme-archive', get_template_directory_uri() . '/assets/js/archive.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'custom_mytheme_enqueue_script');

function draft_enqueue_scripts() {

   
    wp_enqueue_script( 
        'slick', 
        get_stylesheet_directory_uri() . '/assets/js/slick.min.js', 
        array('jquery'), 
        '1.0.0', 
        true 
    );
    wp_enqueue_script( 
        'main-js', 
        get_stylesheet_directory_uri() . '/assets/js/main.js', 
        array('jquery'), 
        '1.0.0', 
        true 
    );
    $translation_array = array(
        "email_placeholder" => esc_attr__( 'Enter your email address here', 'draft' ),
        'ajax_url' => admin_url('admin-ajax.php'),
    );
    wp_localize_script( 'main-js', 'translated_text_object', $translation_array );  
}
add_action( 'wp_enqueue_scripts', 'draft_enqueue_scripts' );






/**
 * Remove default words from archive titles like "Category:", "Tag:", "Archives:"
 */
function draft_remove_default_archive_words($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'draft_remove_default_archive_words');



// function draft_register_custom_taxonomies(){
//    // Add new taxonomy, make it hierarchical (like categories)
//     $labels = array(
//         'name'              => _x( 'Review Sources', 'taxonomy general name', 'draft' ),
//         'singular_name'     => _x( 'Review Source', 'taxonomy singular name', 'draft' ),
//         'search_items'      => __( 'Search Review Sources', 'draft' ),
//         'all_items'         => __( 'All Review Sources', 'draft' ),
//         'edit_item'         => __( 'Edit Review Source', 'draft' ),
//         'update_item'       => __( 'Update Review Source', 'draft' ),
//         'add_new_item'      => __( 'Add New Source', 'draft' ),
//         'not_found'         => __( 'No Review Sources Found!', 'draft' ),
//     );
//     $args = array(
//         'hierarchical'      => true, // Like Category Taxonomy. False is like Tag taxonomy.
//         'labels'            => $labels,
//         'show_ui'           => true,
//         'show_admin_column' => true,
//         'show_in_rest'      => true,
//         'has_archive'       => true,
//         'rewrite'           => array('slug' => 'review-source')
//     );
//     register_taxonomy( 'draft_review_source', array( 'draft_reviews' ), $args ); 
// }
// add_action('init', 'draft_register_custom_taxonomies');


function mytheme_enqueue_customizer_preview_script() {
    wp_enqueue_script(
        'mytheme-customizer-preview',
        get_stylesheet_directory_uri() . '/js/customize.js',
        array( 'customize-preview' ),
        null,
        true
    );
}
add_action( 'customize_preview_init', 'mytheme_enqueue_customizer_preview_script' );


function mytheme_customize_register($wp_customize) {
    $wp_customize->add_setting('retina_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'retina_logo', array(
        'label' => __('Retina Logo', 'mytheme'),
        'section' => 'title_tagline',
        'settings' => 'retina_logo',
    )));
}
add_action('customize_register', 'mytheme_customize_register');


function mytheme_setup() {
    load_theme_textdomain( 'mytheme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );




// function mod_contact7_form_content($template, $prop) {
//     if ('form' == $prop) {
//       return implode('', array(
//         '<div class="row">',
//           '<div class="col">',
//             '[text* your-name placeholder"Name"]',
//             '[email* your-email placeholder"Email"]',
//             '[text* your-subject placeholder"Subject"]',
//           '</div>',
//           '<div class="col">',
//             '[textarea* your-message placeholder"Message"]',
//           '</div>',
//         '</div>',
//         '<div class="row">',
//           '[submit class:btn "Send Mail"]',
//         '</div>'
//       ));
//     } else {
//       return $template;
//     }
//   }
//   add_filter('wpcf7_default_template', 'mod_contact7_form_content',  10,  2);
  
//   function mod_contact7_form_title($template) {
//     $template->set_title('Contact us now');
//     return $template;
//   }
//   add_filter('wpcf7_contact_form_default_pack', 'mod_contact7_form_title');
  
function load_more_posts() {
    check_ajax_referer('mytheme_load_more_posts_nonce', 'security');

    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Output the post content here. You can customize this part as needed.
            echo '<div class="post">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div>' . get_the_excerpt() . '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
    }

    wp_die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


function mytheme_add_meta_box() {
    add_meta_box(
        'mytheme_meta_box', // Unique ID
        'My Theme Meta Box', // Box title
        'mytheme_meta_box_callback', // Callback function
        'post', // Post type
        'normal', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'mytheme_add_meta_box');


function mytheme_meta_box_callback($post) {
    // Use get_post_meta() to retrieve the custom title value
    $custom_title = get_post_meta($post->ID, 'mytheme_custom_title', true);
    
    // Output the form field for the custom title
    echo '<label for="mytheme_custom_title">Custom Title:</label>';
    echo '<input type="text" id="mytheme_custom_title" name="mytheme_custom_title" value="' . esc_attr($custom_title) . '">';
}

function mytheme_save_meta_box_data($post_id) {
    if (isset($_POST['mytheme_custom_title'])) {
        update_post_meta(
            $post_id,
            'mytheme_custom_title',
            sanitize_text_field($_POST['mytheme_custom_title'])
        );
    }
}
add_action('save_post', 'mytheme_save_meta_box_data');
