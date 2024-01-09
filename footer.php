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
<!-- footer.php -->
<footer id="custom-footer">
 <div class="footer-section-two">
   <div id="newsletter-form">
       <h4>Subscribe to Our Newsletter</h4>
       <form action="#" method="post">
           <input type="text" name="email" placeholder="Your email">
           <input type="submit" value="Subscribe">
       </form>
   </div>
 </div>
</footer>
<?php wp_footer(); ?>
