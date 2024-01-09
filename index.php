<?php
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

        // Initialize a counter to keep track of posts
        $post_count = 0;

        // Open the wrapping div for the card group
        echo '<div class="card-group">';

        while (have_posts()) :
            the_post();

            // Display each card within the card group
            echo '<div class="card">';
            if (has_post_thumbnail()) :
                echo '<img class="card-img-top" src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="Card image cap">';
            endif;
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . get_the_title() . '</h5>';
            $post_tags = get_the_tags();
            if ($post_tags) :
                echo '<div class="tag-container">';
                foreach ($post_tags as $index => $tag) :
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                    if ($index < count($post_tags) - 1) echo ', ';
                endforeach;
                echo '</div>';
            endif;
            echo '<p class="card-text">' . get_the_excerpt() . '</p>';
            echo '<p class="card-text"><small class="text-muted">' . get_the_date() . '</small></p>';
            echo '<div class="card-footer">';
            echo '<a href="' . get_the_permalink() . '" class="card-link">Read more</a>';
            echo '</div>'; // Close card-footer
            echo '</div>'; // Close card-body
            echo '</div>'; // Close the card

            $post_count++;

            // Check if two posts have been displayed
            if ($post_count % 2 === 0) {
                // Close the current card group and open a new one
                echo '</div>'; // Close the card-group
                echo '<div class="card-group">'; // Open a new card-group
            }

        endwhile;

        // Close the last card group
        echo '</div>'; // Close the card-group

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
