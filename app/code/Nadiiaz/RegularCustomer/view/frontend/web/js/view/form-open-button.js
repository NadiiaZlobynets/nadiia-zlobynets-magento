define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('Nadiiaz.personalDiscount_formOpenButton', {
        _create: function () {
            $(this.element).on('click.nadiiaz_personal_discount_form_open', this.openRequestForm.bind(this));
        },

        openRequestForm: function () {
            $(document).trigger('nadiiaz_personal_discount_form_open');
        }
    });

    return $.Nadiiaz.personalDiscount_formOpenButton;
});
