/**
 * CF7 Input Wrap
 * ==============================================
 */

;(function ($, window, document, undefined) {
    "use strict";

        if($('.widget_aheto__cf--pointe-center-form input[type="submit"]').length){
            $('.widget_aheto__cf--pointe-center-form input[type="submit"]').each(function () {
                $(this).wrap('<div class="submit-wrap"></div>')
            })
        }
        if($('.widget_aheto__cf--pointe-center-form textarea').length){
            $('.widget_aheto__cf--pointe-center-form textarea').each(function () {
                $(this).closest('.wpcf7-form-control-wrap').wrap('<div class="textarea-wrap"></div>')
            })
        }



})(jQuery, window, document);

