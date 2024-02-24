<?php
/*
Template Name: Contact Form  Template
*/
get_header();

?>
<?php

// Check if the function exists to avoid errors in older versions of WordPress.
if ( function_exists( 'has_block_pattern' ) && has_block_pattern( 'my-theme/featured-article', get_the_ID() ) ) {
  // Your code to render the block pattern or call it.
}


?>


<?php
echo do_shortcode('[contact-form-7 id="554dda6" title="Contact form  1"]');
?>

<?php get_footer(); ?>
