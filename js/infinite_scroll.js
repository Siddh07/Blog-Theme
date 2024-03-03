jQuery(document).ready(function($) {
    var page = 1;
    var loading = false;

    function loadMorePosts() {
        console.log('Function called');
        if (!loading) {
            console.log('Loading...');
            loading = true;



             // Verification line added here:
    console.log(mytheme_ajax_object);
    
            jQuery.ajax({
                type: 'POST',
                url: mytheme_ajax_object.ajax_url,
                data: {
                    action: 'load_more_posts',
                    page: page,
                    security: mytheme_ajax_object.ajax_nonce
                },
                success: function(data) {
                    console.log('Ajax success');
                    if (data) {
                        jQuery('#post-container').append(data);
                        page++;
                        loading = false;
                    } else {
                        loading = false;
                        jQuery('#load-more-posts').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Ajax error:', error);
                }
            });
        }
    }
    
    // Event handler for "Load More" button click
    $('#load-more-btn').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        loadMorePosts();
    });

    // Event handler for scrolling (optional if you still want infinite scroll)
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
            loadMorePosts();
        }
    });
});
