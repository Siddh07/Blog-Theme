<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package draft
 */

?>

<footer id="colophon" class="site-footer">

    <div class="copyright-and-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="copyright">
                        <p><?php printf( '%s. All right reserved &copy; %s', get_bloginfo('name'), date( 'Y' ) ); ?></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-links">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu-list', // Add a custom class for styling
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>

</body>
</html>
