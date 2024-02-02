

<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package draft
 */

get_header();
?>

<?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$blog_posts_query = new WP_Query(
    array(
        'post_type'      => 'post',
        'posts_per_page' => 2,
        'paged'          => $paged // Added pagination parameter
    )  
);
?>

<div class="container">
    <div class="row">
        <div class="blog-posts ">
            <?php if ( $blog_posts_query->have_posts() ) : ?>
                <?php while ( $blog_posts_query->have_posts() ) : $blog_posts_query->the_post(); ?>
                    <div class="blog-post">
                        <?php if ( has_post_thumbnail() ) :
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'dosth-blog-thumbnail' ); ?>
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                        <?php endif; ?>
                        <h1><?php the_title(); ?></h1>
                        <?php echo custom_excerpt(20); // Display 20 words of the excerpt ?>
                      
                        <a class="read-more-link" href="<?php the_permalink(); ?>">
                            <?php echo get_option( 'draft_readmore_text', __( 'Read More', 'draft' ) ); ?>
                        </a>

                        <div class="posted-in">
                            <span><?php _e( 'Posted In', 'draft' ); ?></span>
                            <span><?php the_category( ', ' ); ?></span>
                        </div>
                    </div> <!-- Correct placement of closing div tag -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <!-- end of custom query loop -->

            <?php the_posts_pagination(); ?>
        </div> <!-- Closing div tag for blog-posts col-md-8 -->

        <div id="blog-sidebar" class="col-md-4">
            <?php get_sidebar(); ?>             
        </div>
    </div> <!-- Closing div tag for row -->
</div> <!-- Closing div tag for container -->


<?php get_template_part( 'template-parts/reviews', 'slider' ); ?>
<?php get_footer(); ?>


