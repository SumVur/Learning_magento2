define([
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'jquery',
], function (ko, Component, _, stepNavigator, $) {


    'use strict';

    /**
     * mystep - is the name of the component's .html template,
     * <Vendor>_<Module>  - is the name of your module directory.
     */
    return Component.extend({
        defaults: {
            template: 'Learning_EleventhTask/mystep'
        },

        // add here your logic to display step,
        isVisible: ko.observable(true),

        /**
         * @returns {*}
         */
        initialize: function () {
            this._super();

            // register your step
            stepNavigator.registerStep(
                // step code will be used as step content id in the component template
                'step_code',
                // step alias
                null,
                // step title value
                'Step Title',
                // observable property with logic when display step or hide step
                this.isVisible,

                _.bind(this.navigate, this),

                /**
                 * sort order value
                 * 'sort order value' < 10: step displays before shipping step;
                 * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                 * 'sort order value' > 20 : step displays after payment step
                 */
                0
            );

            return this;
        },

        /**
         * The navigate() method is responsible for navigation between checkout steps
         * during checkout. You can add custom logic, for example some conditions
         * for switching to your custom step
         * When the user navigates to the custom step via url anchor or back button we_must show step manually here
         */
        navigate: function () {
            this.isVisible(true);
        },
        /**
         * @returns void
         */
        FirstName: ko.observable(""),
        LastName: ko.observable(""),
        Email: ko.observable(""),
        Password: ko.observable(""),
        navigateToNextStep: function (formElement) {
            /*создание кастомера*/
            const firstName = this.FirstName();
            const lastName = this.LastName();
            const email = this.Email();
            const password = this.Password();

            $.ajax({
                method: "POST",
                url: "http://magento2.local/graphql",
                contentType: "application/json",
                headers: {
                    Authorization: "bearer ***********"
                },
                data: JSON.stringify({
                    query: `
                    mutation ($firstname: String!,$lastname: String!,$email: String!,$password: String!) {
                          createCustomer(
                            input: {
                              firstname: $firstname
                              lastname:$lastname
                              email: $email
                              password: $password
                              is_subscribed: true
                            }
                          ) {
                            customer {
                              firstname
                              lastname
                              email
                              is_subscribed
                            }
                          }
                        }
                    `,
                    variables: {
                        "firstname": firstName,
                        "lastname": lastName,
                        "email": email,
                        "password": password
                    }
                }),
                complete: function (date) {
                    if (!date['responseText'].includes('errors')) {
                        $.ajax({
                            method: "POST",
                            url: "http://magento2.local/customer/ajax/login",
                            contentType: "application/json",
                            headers: {
                                Authorization: "bearer ***********"
                            },
                            data: JSON.stringify(
                                {
                                    "context": "checkout",
                                    "password": password,
                                    "username": email
                                }
                            )
                        }).done(function () {
                            window.location.href = 'http://magento2.local/checkout/'
                        })
                    }
                }
            }).loader($("body").trigger('processStart'))
        }
    });
});
