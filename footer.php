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

?><footer id="site-footer">
<div class="footer-section-one">
    <?php if (is_active_sidebar('footer-section-one')) : ?>
        <?php dynamic_sidebar('footer-section-one'); ?>
    <?php endif; ?>
</div>

<div class="footer-section-two">
    <div id="newsletter-form">
        <h4>Subscribe to Our Newsletter</h4>
        <!-- Your newsletter form code goes here -->
        <!-- Example form: -->
        <form action="#" method="post">
            <input type="text" name="email" placeholder="Your email">
            <input type="submit" value="Subscribe">
        </form>
    </div>

    <?php if (is_active_sidebar('footer-section-two')) : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php dynamic_sidebar('footer-section-two'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</footer>
