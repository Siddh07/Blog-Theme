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

<main id="primary" class="site-main">

    <?php
	set_post_thumbnail_size(200, 200); // Set the thumbnail size to 200x200 pixels
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

<?php
get_sidebar();
get_footer();
?>
