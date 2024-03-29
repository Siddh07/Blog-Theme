<?php
/**
 * The template for displaying archive of Reviews
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package draft
 */
get_header();
?>
<div class="content-container">
    <h1 class="page-title"><?php post_type_archive_title(); ?></h1>    
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
                                <span class="review-from">
                                    <?php $terms = get_the_terms( get_the_ID() , 'draft_review_source' ); ?>
                                    <?php printf( __( 'From %s', 'draft' ), $terms[0]->name ); ?>
                                </span>
                            </footer>
                        </blockquote>
                    </div>
                <?php endwhile; ?>
                <?php the_posts_pagination(); ?>
            <?php else: ?>
                <p><?php _e( 'No Reviews found', 'draft
                ' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>