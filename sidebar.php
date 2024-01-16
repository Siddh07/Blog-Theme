<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package draft
 */

if ( ! is_active_sidebar( 'blog' ) ) {
	return;
}
?>
  <div id="blog-sidebar" class="col-md-4">
                <?php if ( is_active_sidebar( 'blog' ) ) : ?>
                    <div class="blog-widgets-container">
                        <?php dynamic_sidebar( 'blog' ); ?>
                    </div>
                <?php endif; ?>                
            </div>