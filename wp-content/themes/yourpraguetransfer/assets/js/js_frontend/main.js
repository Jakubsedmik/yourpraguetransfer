
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


/* SWITCH AUTOCOMPLETION ON, CREATE LAT AND LNG */
function initAutocomplete() {

    var inputs = $(".js-autocomplete");

    inputs.each(function () {
        var input = this;
        var subinfoHidden = $(this).closest("div").find(".js-autocomplete-json");

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            var place_json = JSON.stringify(place.address_components);
            if(subinfoHidden.length) {
                subinfoHidden.val(place_json);
            }
        });

    });
}




$(document).ready(function () {

    // SCRIPT LOADER
    jQuery.loadScript = function (url, callback) {
        jQuery.ajax({
            url: url,
            dataType: 'script',
            success: callback,
            async: true
        });
    };

    // POWER UP AUTOCOMPLETE IF IS NEEDED
    var $autocompletes = $(".js-autocomplete");
    if($autocompletes.length > 0){
        $.loadScript('https://maps.googleapis.com/maps/api/js?key=' + serverData.google_api_key + '&libraries=drawing,places', function(){
            initAutocomplete();
        });
    }

});