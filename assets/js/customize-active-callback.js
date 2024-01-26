(function($){
    // Show "Read More Text" Control only if "Show Read More Link" is set to true

    wp.customize.control( 'draft_readmore_text', function( readmore_text_control ) {
        var show_readmore_setting = wp.customize( 'draft_show_readmore' );

        readmore_text_control.active.set( true == show_readmore_setting.get() );
        
        show_readmore_setting.bind( function( updated_value_of_show_readmore_setting ) {
            readmore_text_control.active.set( true == updated_value_of_show_readmore_setting );
        } );
    } );
})(jQuery); 