
/* ARROW */
jQuery(function($) {
    var slide = $(".s7_ftw-arrown"), cur = 0;
    setInterval(function(){
        $('.active',slide).removeClass('active');
        $('i',slide).eq((++cur)%15).addClass('active');
    }, 100 );
});


/* JUSTIFIED GALLERY STARTUP */
jQuery(document).ready(function() {
    jQuery("#car-gallery-fp").justifiedGallery({
        rowHeight: 295,
        maxRowHeight: 100,
        captions : false,
        margins : 0,
        waitThumbnailsLoad: false,
    });
});