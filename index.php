<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package draft
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    if (have_posts()) :

        if (is_home() && !is_front_page()) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        /* Start the Loop */
        $count = 0; // Initialize count for tracking the number of posts
        while (have_posts()) :
            the_post();

            // Open the wrapping div for the post card
            echo '<div class="post-card">';

            // Display the card component
            echo '<div class="card" style="width: calc(30% - 30px); margin-right: 30px; float: left; display: flex; flex-direction: column; margin-top: 20px;">';

            // Check if the post has a featured image
            if (has_post_thumbnail()) :
                // Get the post tags
                $post_tags = get_the_tags();
                // Output the tags as clickable links
                if ($post_tags) {
                    echo '<div style="position: relative;">';
                    echo '<img class="card-img-top" src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="Card image cap">';
                    echo '<div style="position: absolute; top: 0; left: 0; background-color: rgba(255, 255, 255, 0.7); padding: 5px;"> ';

                    // Output clickable links for each tag
                    foreach ($post_tags as $tag) {
                        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>, ';
                    }

                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<img class="card-img-top" src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="Card image cap">';
                }

            endif;

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . get_the_title() . '</h5>';
            echo '<p class="card-text">' . get_the_excerpt() . '</p>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush">';
            echo '<li class="list-group-item">' . get_the_date() . '</li>';
            echo '<li class="list-group-item">' . get_the_author() . '</li>';
            echo '</ul>';
            echo '<div class="card-body">';
            echo '<a href="' . get_the_permalink() . '" class="card-link">Read more</a>';
            echo '</div>';

            echo '</div>'; // Close the card component

            // Close the wrapping div for the post card
            echo '</div>';

            $count++;
            // Break the loop after displaying 3 posts
            if ($count >= 3) :
                break;
            endif;

        endwhile;

        the_posts_navigation();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
