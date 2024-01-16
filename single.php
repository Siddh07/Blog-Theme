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
 <!-- <aside class="sidebar">
            <div class="container">
                <div class="row">
                    <div class="article-info col-md-3">
                        <?php $categories = get_the_category();
                        if (!empty($categories)) : ?>
                            <div class="posted-in">
                                <h4><?php _e('Posted In', 'nd_dosth'); ?></h4>
                                <?php the_category(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="published-on">
                            <h4><?php _e('Publish On', 'nd_dosth'); ?></h4>
                            <?php the_date(); ?>
                        </div>

                        <div class="post-author">
                            <h4><?php _e('Author', 'nd_dosth'); ?></h4>
                            <a class="author-archive" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                            <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                        </div>
                    </div>

                    <div id="actual-article" class="col-md-8">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div></aside> -->
<main id="primary" class="site-main">

   
        <?php
    set_post_thumbnail_size(10, 10); // Set the thumbnail size to 200x200 pixels
    while (have_posts()) :
        the_post();
        if (has_post_thumbnail()) {
		}
  
		get_template_part('template-parts/content', get_post_type());
  
		// Display post navigation
		?>
        <div class="row">
            <?php
            // Previous Post
            $prevPost = get_previous_post();
            if ($prevPost) :
            ?>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo esc_url(get_permalink($prevPost)); ?>"><?php esc_html_e('Previous', 'draft'); ?></a></h5>
                        <p class="card-text">
                            <a href="<?php echo esc_url(get_permalink($prevPost)); ?>" class="btn btn-primary"><?php echo esc_html($prevPost->post_title); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php
            // Next Post
            $nextPost = get_next_post();
            if ($nextPost) :
            ?>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo esc_url(get_permalink($nextPost)); ?>"><?php esc_html_e('Next', 'draft'); ?></a></h5>
                        <p class="card-text">
                            <a href="<?php echo esc_url(get_permalink($nextPost)); ?>" class="btn btn-primary"><?php echo esc_html($nextPost->post_title); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main><!-- #main -->

