<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package draft
 */

get_header();
?>

<div class="content-container">
    <h1 class="page-title"><?php _e( 'OOPS! You took a wrong turn :(', "draft" ); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="big-404-page">
                    <?php _e( '404', "draft" ); ?>
                </div>
                <p><?php _e( "But that's totally ok, Can't blame yourself.", 'draft' ); ?></p>
                <p><?php _e( "Anyway, the page you are looking for doesn't exist any more or might never existed.", 'draft' ); ?></p>
                <div class="menu-button">
                    <a href="<?php echo esc_url( 'index.php/articles/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <?php _e( 'Go Home', 'draft' ); ?>
                    </a>
                </div>
                <div class="or"><?php _e( 'or', 'draft' ); ?></div>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>