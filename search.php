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

<div class="content-container">
<h1 class="page-title"><?php _e( 'Search results for:', 'nd_dosth' ); ?></h1>
<div class="search-query"><?php echo get_search_query(); ?></div>    
<div class="container">
	<div class="row">
		<div class="search-results col-md-8">
		<?php if ( have_posts() ): ?>
			<?php while( have_posts() ): ?>
				<?php the_post(); ?>
				<div class="search-result">
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="read-more-link">
						<?php _e( 'Read More', 'nd_dosth' );  ?>
					</a>
				</div>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else: ?>
			<p><?php _e( 'No Search Results found', 'nd_dosth' ); ?></p>
		<?php endif; ?>
		</div>
		<div id="blog-sidebar" class="col-md-4">
			<?php get_sidebar(); ?>             
		</div>
	</div>
</div>
</div>



<div class="container">
<div class="row ng-scope">
    <div class="col-md-3 col-md-push-9">
        <h4>Results <span class="fw-semi-bold">Filtering</span></h4>
        <p class="text-muted fs-mini">Listed content is categorized by the following groups:</p>
        <ul class="nav nav-pills nav-stacked search-result-categories mt">
            <li><a href="#">Friends <span class="badge">34</span></a>
            </li>
            <li><a href="#">Pages <span class="badge">9</span></a>
            </li>
            <li><a href="#">Images</a>
            </li>
            <li><a href="#">Groups</a>
            </li>
            <li><a href="#">Globals <span class="badge">18</span></a>
            </li>
        </ul>
    </div>
    <div class="col-md-9 col-md-pull-3">
        <p class="search-results-count">About 94 700 000 (0.39 sec.) results</p>
        <section class="search-result-item">
            <a class="image-link" href="#"><img class="image" src="https://bootdey.com/img/Content/avatar/avatar1.png">
            </a>
            <div class="search-result-item-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="search-result-item-heading"><a href="#">john doe</a></h4>
                        <p class="info">New York, NY 20188</p>
                        <p class="description">Not just usual Metro. But something bigger. Not just usual widgets, but real widgets. Not just yet another admin template, but next generation admin template.</p>
                    </div>
                    <div class="col-sm-3 text-align-center">
                        <p class="value3 mt-sm">$9, 700</p>
                        <p class="fs-mini text-muted">PER WEEK</p><a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="search-result-item">
            <a class="image-link" href="#"><img class="image" src="https://bootdey.com/img/Content/avatar/avatar6.png">
            </a>
            <div class="search-result-item-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="search-result-item-heading"><a href="#">john doe</a> <span class="badge bg-danger fw-normal pull-right">Best Deal!</span></h4>
                        <p class="info">Los Angeles, NY 20188</p>
                        <p class="description">You will never know exactly how something will go until you try it. You can think three hundred times and still have no precise result.</p>
                    </div>
                    <div class="col-sm-3 text-align-center">
                        <p class="value3 mt-sm">$10, 300</p>
                        <p class="fs-mini text-muted">PER WEEK</p><a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
       
       
    </div>
</div>
</div>




<?php get_footer(); ?>