<?php 
    $reviews_query = new WP_Query(
        array(
            'post_type' => 'draft_reviews',
            "posts_per_page" => 4,
            'order_by' => 'menu_order'
        )   
    );
?>
<!-- reviews custom query loop -->
<?php if( $reviews_query->have_posts() ): ?>
    <section class="reviews-container make-it-slick">
        <h2><?php _e( 'What People Are Saying', 'draft' ); ?></h2>
        <div class="draft-reviews">
            <?php while( $reviews_query->have_posts() ): ?>
                <?php $reviews_query->the_post(); ?>
                <div class="review">
                    <blockquote>
                        <?php the_content(); ?>
                        <footer>
                            <cite><?php the_title(); ?></cite>
                            <span class="review-from">
                                <?php printf( __( 'From %s', 'draft' ), get_field('source') ); ?>
                            </span>
                        </footer>
                    </blockquote>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
<?php endif;  ?>
<!-- end of reviews custom query loop -->