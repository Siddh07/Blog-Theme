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

<div class="container">
    <div class="row">
        <div class="blog-posts col-md-8">
            <?php if ( have_posts() ): ?>
                <?php while( have_posts() ): ?>
                    <?php the_post(); ?>
                    <div class="blog-post">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php if ( has_post_thumbnail() ) :
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'dosth-blog-thumbnail' ); ?>
                            <div class="blog-post-thumb">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                            </div>
                        <?php endif; ?>
                        <?php echo custom_excerpt(20); // Display 20 words of the excerpt ?>
                        
                        <a class="read-more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read More' ); ?></a>
                        <div class="posted-in">
                            <span><?php _e( 'Posted In', 'nd_dosth' ); ?></span>
                            <span><?php the_category( ', ' ); ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>

                
                
                
                <?php 
$blog_posts_query = new WP_Query(
   array(
       'post_type'     => 'post',
       'posts_per_page' => 2
   )  
);
?>
<?php if ( $blog_posts_query->have_posts() ): ?>
   <?php while( $blog_posts_query->have_posts() ): ?>
       <?php $blog_posts_query->the_post(); ?>
       <div class="blog-post">
       <?php if ( has_post_thumbnail() ) :
           $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'dosth-blog-thumbnail' ); ?>
           <div class="blog-post-thumb">
               <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
           </div>
       <?php endif; ?>
       <?php the_title('<h1>', '</h1>'); ?>
       <?php echo custom_excerpt(20); // Display 20 words of the excerpt ?>
       <a class="read-more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read More' ); ?></a>
       <div class="posted-in">
           <span><?php _e( 'Posted In', 'nd_dosth' ); ?></span>
           <span><?php the_category( ', ' ); ?></span>
       </div>
       </div> <!-- Correct placement of closing div tag -->
   <?php endwhile; ?>
   <?php wp_reset_postdata(); ?>
<?php endif; ?>
<!-- end of custom query loop -->

<?php the_posts_pagination(); ?>
<?php else: ?>
   <p><?php _e( 'No Blog Posts found', 'nd_dosth' ); ?></p>
<?php endif; ?>

</div>
<div id="blog-sidebar" class="col-md-4">
                <?php get_sidebar(); ?>             
            </div>
</div>
</div>
<?php get_template_part( 'template-parts/reviews', 'slider' ); ?>
<?php get_footer(); ?>
