(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {
            $('#carousel-div').carousel({
                interval: 4000 //TIME IN MILLI SECONDS
            });

        },
        wow_fun: function () {

            new WOW().init();

        },
        gallery: function () {
            $(".lightgallery").lightGallery();
        }

    }
    $(document).ready(function () {
        mainApp.slide_fun();
        mainApp.wow_fun();
        mainApp.gallery();
    });
}(jQuery));

//CLIENTS SECTION SCRIPTS
$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 200,
        itemMargin: 15,
        pausePlay: false,
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });
});


