<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package draft
 */

if ( ! function_exists( 'draft_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function draft_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'draft' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'draft_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function draft_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'draft' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'draft_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags, and comments.
     */
    function draft_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            $categories_list = get_the_category_list( esc_html__( ', ', 'draft' ) );
            if ( $categories_list ) {
                // Add a surrounding div with a custom class.
                echo '<div class="categories-wrapper">';
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'draft' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</div>';
            }

            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'draft' ) );
            if ( $tags_list ) {
                // Add a surrounding div with a custom class.
                echo '<div class="tags-wrapper">';
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'draft' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</div>';
            }
        }

        // Rest of the code...
    }
endif;

if ( ! function_exists( 'draft_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function draft_post_thumbnail() {
        // Check if the post requires a password, is an attachment, or has no thumbnail; if true, return early.
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        // Determine the class for the thumbnail container based on whether it's a singular view or inline layout.
        $thumbnail_classes = is_singular() ? 'post-thumbnail' : 'post-thumbnail-inline';

        // Check if it's a singular view.
        if ( is_singular() ) :
            ?>
            <!-- Display the post thumbnail in a Bootstrap card on single views -->
            <div class="card">
                <?php
                the_post_thumbnail(
                    'small-thumbnail',
                    array(
                        'class' => 'card-img-top',
                        'alt'   => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
                <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
              
                    <!-- Remove or comment out the line below to remove the "Read more" button -->
               
                </div>
            </div><!-- .card -->
        <?php else : ?>
            <!-- Display the post thumbnail in an anchor element with the determined class, linking to the post's permalink -->
            <a class="<?php echo esc_attr( $thumbnail_classes ); ?>" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <!-- Display the post thumbnail in a Bootstrap card on index views -->
                <div class="card">
                    <?php
                    the_post_thumbnail(
                        'small-thumbnail',
                        array(
                            'class' => 'card-img-top',
                            'alt'   => the_title_attribute(
                                array(
                                    'echo' => false,
                                )
                            ),
                        )
                    );
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p >  <?php the_date(); ?></p>
                    </div>
                </div><!-- .card -->
            </a>
        <?php
        endif; // End is_singular().
    }
endif;


if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
