(function($){
    /* Show/Hide Read More link inside Site Preview */
	wp.customize( 'draft_show_readmore', function( value_of_show_readmore_setting ) {
        
	    value_of_show_readmore_setting.bind( function( updated_value_of_show_readmore_setting ) {
		    if( true == updated_value_of_show_readmore_setting ){
                $('.read-more-link').show();
            } else{
                $('.read-more-link').hide();
            }
        } );
        
    } );
    
    /* Shows a live preview of changing the Primary Color of the theme. */
    wp.customize( 'draft_color_primary', function( color_code ) {
        color_code.bind( function( updated_color_code ) {

            // Primary color as background color
            $( '#site-footer .es_button input, .slick-dots li.slick-active, .menu-button a, .content-container .page-title, .pagination .nav-links a, .pagination .nav-links .current, #commentform input[type="submit"]' )
            .not( '.archive .page-title, .blog .page-title, .search .page-title' )
            .css( 'background-color', updated_color_code );

            // Primary color as text color
            $( '#announcement .announcement-title, .draft-reviews blockquote p, .search-results .page-title, .current-menu-item a, #blog-sidebar .widget .current-cat a, .previous-article' )
            .css( 'color', updated_color_code );

            
        } ); 
    } ); 

    /* Shows a live preview of changing the Secondary Color of the theme. */
    wp.customize( 'draft_color_secondary', function( color_code ) {
        color_code.bind( function( updated_color_code ) {

            // Secondary color as background color
            $( '#announcement' )
            .css( 'background-color', updated_color_code );

            // Secondary color as text color
            $( '.blog .page-title, .archive .page-title, .read-more-link, .posted-in a, .widget-title, .single .article-info a, .comment-reply-link, .next-article, .single .related-articles h2, .search-results .search-query' )
            .css( 'color', updated_color_code );

            
        } ); 
    } ); 
    
})(jQuery);



(function($){
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            $('.site-title a').text(newval);
        });
    });
})(jQuery);

