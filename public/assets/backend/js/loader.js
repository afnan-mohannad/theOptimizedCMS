jQuery(window).on('load', function() {
    /* =============================================
        24.0 - Pre Loader
    ============================================= */
    //$('body').imagesLoaded( function() {
        $('#pre-loader').fadeOut();
        $('body').css({"overflow": "visible"});
    //});
});