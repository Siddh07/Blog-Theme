<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package draft
 */

get_header();
?>





<h1 class="page-title"><?php _e( 'Search results for:', 'nd_dosth' ); ?></h1>
<div class="search-query"><?php echo get_search_query(); ?></div>    


<div class="seach-container">

    <div class="seach-row">

        <div class="seach-col-md-9 col-md-pull-3">

            <section class="seach-search-result-item">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if (get_post_type() == 'post') : // Check if the current item is a post 
                        ?>

                            <div class="gap">
                                <a class="image-link" href="<?php the_permalink(); ?>"><img class="image">
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'image')); ?>
                                </a>
                                <div class="seach-search-result-item-body">
                                    <div class="seach-row">
                                        <div class="seach-col-sm-9">
                                            <h4 class="seach-search-result-item-heading">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <p class="search-info">


                                            <?php if (has_excerpt()) : ?>
                                                <p class="search-info"><?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                                    <a class="continue-reading" href="<?php the_permalink(); ?>">Continue Reading</a>
                                                </p>
                                            <?php endif; ?>

                                        </p>
                                        </div>
                                        <div class="seach-col-sm-3 text-align-center">
                                            <p class="seach-fs-mini text-muted"><?php the_category(', '); ?></p>
                                            <a class="seach-sbtn btn-primary btn-info btn-sm" href="<?php the_permalink(); ?>">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                     <!-- Display Pagination Only If There Are Posts -->
                <?php if (have_posts()) : ?>
                    <div class="pagination">
                        <?php the_posts_pagination(array(
                            'prev_text' => __('« Previous'),
                            'next_text' => __('Next »'),
                        )); ?>
                    </div>
                <?php endif; ?>
                <!-- End Pagination -->
                <?php else : ?>
                    <p><?php _e('No Search Results found', 'nd_dosth'); ?></p>
                <?php endif; ?>
            </section>
        </div>
    </div>

</div>

<?php get_footer(); ?>