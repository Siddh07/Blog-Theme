<?php
/**
 * The template for displaying archive of draft Review Source taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package draft
 */
get_header();
?>
<div class="content-container">
    <h1 class="page-title">
    <?php _e( 'Reviews From: ' ); ?><?php echo single_term_title(); ?>
    </h1>    
    <div class="reviews-container">
        <div class="draft-reviews">
            <?php if ( have_posts() ): ?>
                <?php while( have_posts() ): ?>
                    <?php the_post(); ?>
                    <div class="review">
                        <blockquote>
                            <?php the_content(); ?>
                            <footer>
                                <cite><?php the_title(); ?></cite>
                            </footer>
                        </blockquote>
                    </div>
                <?php endwhile; ?>
                <?php the_posts_pagination(); ?>
            <?php else: ?>
                <p><?php _e( 'No Reviews found', 'draft' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

