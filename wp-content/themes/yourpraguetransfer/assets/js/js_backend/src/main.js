
function confirmPopup(element, action){
    if($(".confirmPopup").length){
        var confirmPopUpElement = $(".confirmPopup");
    }else{
        var confirmPopUpElement = '<div class="fshr-confirmPopup">';
        var text = $(element).attr("data-popuptext") || "Opravdu toto chcete provést";
        var confirmText = $(element).attr("data-popupconfirm") || "Potvrdit";
        var denyText = $(element).attr("data-popupdeny") || "Zrušit";

        confirmPopUpElement += '<div class="fshr-innerConfirmPopup">';
        confirmPopUpElement += '<h3 class="">' + text + '</h3>';
        confirmPopUpElement += '<div class="fshr-confirmPopupButtons"><button class="fshr-confirm js-confirm">' + confirmText + '</button><button class="fshr-deny js-deny">' + denyText + '</button></div>'
        confirmPopUpElement += '</div>';
        confirmPopUpElement += '</div>';
        confirmPopUpElement = $(confirmPopUpElement);
        $("body").append(confirmPopUpElement);
    }
    confirmPopUpElement.hide();
    confirmPopUpElement.fadeIn(300);

    confirmPopUpElement.on("click", ".js-confirm", function(e){
        if(action && {}.toString.call(action) === '[object Function]'){
            action();
        }else{
            if(window.hasOwnProperty(action)){
                window[action](element);
            }
        }
        if(typeof action == "string"){
            element.trigger(action);
        }
        confirmPopUpElement.fadeOut(300);
    });

    confirmPopUpElement.on("click", ".js-deny", function(e){
        confirmPopUpElement.fadeOut(300);
    });
}

$(document).ready(function () {
    $("body").on("click",".js-let-confirm", function (e) {
        e.preventDefault();
        confirmPopup(this, "submitForm");
    });

    $("form").on("submit", function () {

    });
});

$(window).on("load", function () {
    initMap();
});



/* BOOTSTRAP MDB SELECT */
$(document).ready(function() {
    $('.mdb-select').materialSelect();
    jQuery.extend( jQuery.fn.pickadate.defaults, {
        monthsFull: [ 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec' ],
        monthsShort: [ 'led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čvc', 'srp', 'zář', 'říj', 'lis', 'pro' ],
        weekdaysFull: [ 'neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota' ],
        weekdaysShort: [ 'ne', 'po', 'út', 'st', 'čt', 'pá', 'so' ],
        today: 'dnes',
        clear: 'vymazat',
        firstDay: 1,
        format: 'd. mmmm yyyy',
        formatSubmit: 't',
        hiddenPrefix: 'db_',
        hiddenSuffix: ''
    });
    $('.datepicker').pickadate();
});



var map;
function initMap() {

    // The map, centered at Uluru

    var mapElement = $('.preview-map');
    var lat = mapElement.attr("data-lat") || false;
    var lng = mapElement.attr("data-lng") || false;

    if(!lat || !lng ){
        mapElement.addClass("no-cordinates");
        return false;
    }


    lat = parseFloat(lat);
    lng = parseFloat(lng);

    var cords = {"lat": lat, "lng": lng};

    console.log(cords);
    var map = new google.maps.Map(
        mapElement[0],
        {
            zoom: 4,
            center: cords
        }
        );

    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: cords, map: map});
}


/** FILE UPLOADER **/

$(document).ready(function () {

    var element = $(".js-fileUploader");

    if(element.length > 0){

        var input = element.find("input[type=file]");
        var ajax_url = element.data("ajax-url") || '/yourpraguetransfer/wp-admin/admin-ajax.php';

        console.log("Setting uploader");
        FilePond.setOptions({
            server: {
                url: ajax_url,
                method: 'POST',
                process: {
                    onload: function (response) {
                        window.app.$children[0].fetchData();
                    },
                    ondata: function (formData) {
                        formData.append('action', 'upload');
                        return formData;
                    }
                }

            },
            maxFiles: 10,
            allowMultiple: true,
            maxParallelUploads : 3,
            labelIdle : "<i class=\"far fa-image\"></i> Nahrajte nové obrázky (maximálně 10 v jednu chvíli) <span class=\"filepond--label-action\"> Procházet </span>",
            labelFileLoading : "Načítání",
            labelFileProcessing : "Uploadování",
            labelFileProcessingComplete : "Úspěšně nahráno na server",
            labelFileProcessingAborted: "Zrušeno",
            labelTapToCancel: "Klepněte pro zrušení",
            labelTapToRetry: "Klepněte pro opakování",
            allowRevert: false

        });

        var pond = FilePond.create( input[0] );
    }


    var singleFileUploader = $(".js-singleFileUploader");


    if(singleFileUploader.length > 0){

        var ajax_url = singleFileUploader.data("ajax-url") || '/realsys/wp-admin/admin-ajax.php';
        var primaryName = singleFileUploader.data("property-name") || 'db_url';
        var secondaryName = singleFileUploader.data("secondary-property-name") || 'db_kod';
        var input = singleFileUploader.find("input[type=file]");

        FilePond.setOptions({
            server: {
                url: ajax_url,
                method: 'POST',
                process: {
                    onload: function (response) {
                        response = JSON.parse(response);
                        singleFileUploader.find(".js-singleFileUploaderImage").attr("src", response.default_url);
                        singleFileUploader.find("input[name=" + primaryName + "]").val(response.default_url);
                        singleFileUploader.find("input[name=" + secondaryName + "]").val(response.universal_name);
                    },
                    ondata: function (formData) {
                        formData.append('action', 'upload');
                        formData.append('onlyupload', true);
                        return formData;
                    }
                }

            },
            allowMultiple: false,
            labelIdle : "<i class=\"far fa-image\"></i> Nahrajte nový obrázek <span class=\"filepond--label-action\"> Procházet </span>",
            labelFileLoading : "Načítání",
            labelFileProcessing : "Uploadování",
            labelFileProcessingComplete : "Úspěšně nahráno na server",
            labelFileProcessingAborted: "Zrušeno",
            labelTapToCancel: "Klepněte pro zrušení",
            labelTapToRetry: "Klepněte pro opakování",
            allowRevert: false

        });

        var pond = FilePond.create( input[0] );
    }

});


/* SECONDARY MEDIA UPLOADER */

jQuery(function($){

    var imageContainer = $(".js-change-image-container");
    var imageChanger = imageContainer.find(".js-change-image");
    var imageValue = imageContainer.find(".js-change-image-value");
    var imageHolder = imageContainer.find(".js-change-image-img");
    var frame;
    // ADD IMAGE LINK
    imageChanger.on( 'click', function( event ){

        event.preventDefault();

        if ( frame ) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Vyberte obrázek',
            button: {
                text: 'Použít tento obrázek'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            imageHolder.attr("src",attachment.url);
            imageValue.val(attachment.url);
        });

        // Finally, open the modal on click
        frame.open();
    });


});


/* JS DETAIL BUTTON */
jQuery(function($){
    $("body").on("change" , ".js-detail-button select", function (e) {
        var parent = $(this).closest(".js-detail-button");
        var href = parent.find("a.btn").attr("href");
        href = updateURLParameter(href, 'id', $(this).val());
        parent.find("a.btn").attr("href", href).removeClass("disabled");
    });

    var href = $(".js-detail-button a.btn").attr("href");
    if(href && href.search("id")== -1){
        $(".js-detail-button a.btn").addClass("disabled");
    }

});


/* URL CHANGER */

function updateURLParameter(url, param, paramVal){
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}