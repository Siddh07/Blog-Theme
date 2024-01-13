<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package draft
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div id="blog-sidebar" class="col-md-4">
 
        <?php dynamic_sidebar('sidebar-1'); ?>
 
</div>
