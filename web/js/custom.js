'use strict';

var APP = window.APP = window.APP || {};

APP.formcontact = (function () {
    var form;

    function init() {

        var options = {
            success: function (response) {
                contactoFormCallback(response);
            },
            beforeSubmit: function (arr, $form, options) {
                form      = $form;
                var valid = validate();

                if (!valid) {
                    return false;
                }

                $form.find('button').prop("disabled", true).addClass('hide');
                $form.find('.spinner').removeClass('hide');
            }
        };

        $('.frm-send-wdg').ajaxForm(options);
    }

    function contactoFormCallback(response) {

        if (response.msn === 'ERROR') {
            alert('Hubo un error en el servidor');
            return;
        }
        $('.contact_wrp').empty()
            .append("<div>" +
                "<h2 class='text-center'>Muchas gracias. El formulario ha sido enviado</h2>" +
                "</div>");

        init();
    }

    function validate() {
        var fields = {
            name: form.find('.frm-name'),
            email: form.find('.frm-email'),
            phone: form.find('.frm-phone'),
        };

        fields.name.closest('div').find('p').remove();
        fields.email.closest('div').find('p').remove();
        fields.phone.closest('div').find('p').remove();

        var valid = true;
        var val;

        val = fields.name.val();
        if (typeof val === 'undefined' || val === '') {
            addError(fields.name, 'Requerido');
            valid = false;
        }

        val = fields.email.val();
        if (typeof val === 'undefined' || val === '') {
            addError(fields.email, 'Requerido');
            valid = false;
        }
        val = fields.phone.val();
        if (typeof val === 'undefined' || val === '') {
            addError(fields.phone, 'Requerido');
            valid = false;
        }


        val = fields.email.val();
        if (val === '' || typeof val === 'undefined' || !/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(val)) {
            addError(fields.email, 'Correo electronico no valido');
            valid = false;
        }


        return valid;

    }

    function addError(field, error) {
        var cls = field.closest('div');
        cls.find('p').remove();
        cls.append('<p style="color: red">' + error + '</p>');
    }

    /**
     * interfaces to public functions
     */
    return {
        init: init
    };
}());

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
        APP.formcontact.init();
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




