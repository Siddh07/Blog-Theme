<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package draft
 */
?>



    <?php draft_post_thumbnail(); ?>

    <div class="entry-content">
        <?php

        
        if (is_singular()) :
            the_content(); // Display the full content of the post
        else :
            the_excerpt(); // Display the excerpt instead of the full content
        endif;

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'draft'),
                'after' => '</div>',
            )
        );
        ?>
    </div>

