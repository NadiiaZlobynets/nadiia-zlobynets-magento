define([
    'jquery',
    'uiComponent',
    'Nadiiaz_RegularCustomer_formSubmitRestrictions'
], function ($, Component, formSubmitRestrictions) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Nadiiaz_RegularCustomer/form-open-button'
        },

        formSubmitIsRestricted: formSubmitRestrictions.formSubmitDeniedMessage,

        /**
         * Generate event to open the form
         */
        openRequestForm: function () {
            $(document).trigger('nadiiaz_personal_discount_form_open');
        }
    });
});
