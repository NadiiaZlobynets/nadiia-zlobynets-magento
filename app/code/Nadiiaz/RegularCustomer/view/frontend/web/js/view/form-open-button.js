define([
    'jquery',
    'ko',
    'uiComponent',
    'Nadiiaz_RegularCustomer_formSubmitRestrictions'
], function ($, ko, Component, formSubmitRestrictions) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Nadiiaz_RegularCustomer/form-open-button'
        },

        /**
         * Initialize data links (listens/imports/exports/links)
         * @returns {*}
         */
        initLinks: function () {
            this._super();

            // Check whether it is possible to open the modal - either form is modal or there are any other restrictions
            this.canShowOpenModalButton = ko.computed(function () {
                return this.isModal && !formSubmitRestrictions.formSubmitDeniedMessage();
            }.bind(this));

            return this;
        },

        /**
         * Generate event to open the form
         */
        openRequestForm: function () {
            $(document).trigger('nadiiaz_personal_discount_form_open');
        }
    });
});
