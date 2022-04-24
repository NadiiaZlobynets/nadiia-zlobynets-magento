define([
    'jquery',
    'Magento_Customer/js/customer-data',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
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
            isModal: true
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

            this.updateFormState(customerData.get('personal-discount')());
            customerData.get('personal-discount').subscribe(this.updateFormState.bind(this));
        },

        /**
         * Pre-fill form fields with data, hide fields if needed.
         */
        updateFormState: function (personalInfo) {

            if (!!personalInfo.isLoggedIn) {
                $('.nadiiaz-form-input').hide();
            } else {
                $('input[type=text][name=name]').val(personalInfo.name);
                $('input[type=email][name=email]').val(personalInfo.email);
                console.log(personalInfo.email)
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

    return $.Nadiiaz.personalDiscount_form;
});
