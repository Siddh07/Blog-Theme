jQuery(document).ready(function($) {
    var page = 1;
    var loading = false;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
            loading = true;
            $.ajax({
                type: 'POST',
                url: mytheme_ajax_object.ajax_url,
                data: {
                    action: 'load_more_posts',
                    page: page,
                    security: mytheme_ajax_object.ajax_nonce
                },
                success: function(data) {
                    if (data) {
                        $('#post-container').append(data);
                        page++;
                        loading = false;
                    } else {
                        loading = false;
                    }
                }
            });
        }
    });
});
