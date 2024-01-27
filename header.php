<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package draft
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <?php wp_head(); ?>
</head>








<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'draft'); ?></a>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                // Display the custom logo
                the_custom_logo();
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'navbar-nav',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
                ?>
            </div>
        </nav>

        <header id="masthead" class="site-header">
            <div class="site-branding">
                <?php
                if (is_front_page() && is_home()) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
                endif;
                $draft_description = get_bloginfo('description', 'display');
                if ($draft_description || is_customize_preview()) :
                    ?>
                    <p class="site-description"><?php echo $draft_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->
        </header><!-- #masthead -->
