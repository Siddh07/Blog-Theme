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

<div id="newsletter-form">
       <h4>Subscribe to Our Newsletter</h4>
       <form action="#" method="post">
           <input type="text" name="email" placeholder="Your email">
           <input type="submit" value="Subscribe">
       </form>
   </div>
<footer id="site-footer">


 
<footer id="site-footer">
            <?php if ( is_active_sidebar( 'footer-section-one' ) ) : ?>
                <div class="footer-section-one">
                    <?php dynamic_sidebar( 'footer-section-one' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-section-two' ) ) : ?>
                <div class="footer-section-two">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php dynamic_sidebar( 'footer-section-two' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="copyright-and-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="copyright">
                                <p>
                                    <?php 
                                    printf( 
                                        '%s. %s &copy; %s', 
                                        get_bloginfo('name'), 
                                        get_theme_mod('draft_copyright_text', __( 'All Rights Reserved', 'draft' ) ),
                                        date_i18n( 'Y' )
                                    ); 
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-links">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'footer',
                                    ) );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>