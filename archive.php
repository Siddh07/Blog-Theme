<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package draft
 */

get_header();
?>









<div class="container">
<?php
$args = array(
    'post_type' => 'post', // Specify the post type
    'posts_per_page' => 2, // Number of posts to display
    'orderby' => 'date', // Order posts by date
    'order' => 'DESC', // Sort posts in descending order
);

$posts_query = new WP_Query($args);

if ($posts_query->have_posts()) :
    while ($posts_query->have_posts()) : $posts_query->the_post();
        ?>
        <div class="card">
            <div class="card-header">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium', ['alt' => get_the_title()]);
                }
                ?>
            </div>
            <div class="card-body">
                <span class="tag tag-teal"><?php echo get_the_category_list(', '); ?></span>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <div class="user">
                    <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                    <div class="user-info">
                        <h5><?php the_author(); ?></h5>
                        <small><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></small>
                    </div>
                </div>
            </div>
        </div>

 
 <?php
    endwhile;
    
    wp_reset_postdata();
    
else :
    echo 'No posts found.';
endif;
?>
</div>
