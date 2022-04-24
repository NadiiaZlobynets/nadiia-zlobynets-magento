define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
    'mage/cookies',
    'uiComponent',
    'ko'
], function ($, alert, Component, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            customerName: '',
            customerEmail: '',
            customerMessage: '',
            template: 'Nadiiaz_RegularCustomer/form'
        },
        initialize: function() {
            this._super();
        },

        sendRequest: function () {
            console.log('Going to submit the form');
        }
    });

    //----
    $.widget('Nadiiaz.personalDiscount_form', {
        options: {
            action: '',
            isModal: false
        },

        /**
         * @private
         */
        _create: function () {
            $(this.element).on('submit.nadiiaz_personal_discount_form', this.sendRequest.bind(this));

            if (this.options.isModal) {
                $(this.element).modal({
                    buttons: []
                });
                $(document).on('nadiiaz_personal_discount_form_open', this.openModal.bind(this));
            }

            //if ($(this.element).find("input[name='product_id']") === ($.formData.getAll('productIds')).indexOf() < 0) {
                // $(this.element).hide();

            //}
            checkIfProductWasRequested();
        },

        /**
         * Check if product was requested
         */
        checkIfProductWasRequested: function () {
            let productId = $("input[name=product_id]").val();

            productId  = 0;



            if (response.productIds.includes(this.productId)) {
                $(this.element).hide();
            }
        },

        /**
         * Open modal dialog
         */
        openModal: function () {
            $(this.element).modal('openModal');
        },

        /**
         * Validate form and send request
         */
        sendRequest: function () {
            if (!this.validateForm()) {
                return;
            }

            this.ajaxSubmit();
        },

        /**
         * Validate request form
         */
        validateForm: function () {
            return $(this.element).validation().valid();
        },

        /**
         * Submit request via AJAX. Add form key to the post data.
         */
        ajaxSubmit: function () {
            let formData = new FormData($(this.element).get(0));

            // Form key is not appended when the form is in the tab. Must add it manually
            formData.append('form_key', $.mage.cookies.get('form_key'));
            formData.append('isAjax', 1);

            $.ajax({
                url: this.options.action,
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                dataType: 'json',
                context: this,

                /** @inheritdoc */
                beforeSend: function () {
                    $('body').trigger('processStart');
                },

                /**
                 * Success means that response from the server was received, but not that the request was saved!
                 *
                 * @inheritdoc
                 */
                success: function (response) {
                    alert({
                        title: $.mage.__('Posting your request...'),
                        content: response.message
                    });

                    alert({
                        title: $.mage.__('Already requested!'),
                        content: $.mage.__('Your request can\'t be sent. The product is already requested!')
                    });

                },

                /** @inheritdoc */
                error: function () {
                    alert({
                        title: $.mage.__('Error'),
                        content: $.mage.__('Your request can\'t be sent. Please, contact us if you see this message.')
                    });
                },

                /** @inheritdoc */
                complete: function () {
                    if (this.options.isModal) {
                        $(this.element).modal('closeModal');
                    }

                    $('body').trigger('processStop');
                }
            });
        }
    });

    /** Return the module to RequireJS engine */
    return $.Nadiiaz.personalDiscount_form;
});
