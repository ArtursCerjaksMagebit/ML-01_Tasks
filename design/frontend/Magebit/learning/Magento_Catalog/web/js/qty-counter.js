'use strict';

define([
    'ko',
    'uiElement',
], function (ko, Element) {
    return Element.extend({
        defaults: {
            template: 'Magento_Catalog/input-counter',
            title: 'Quantity'
        },
        initialize: function () {
            this._super();
        },
        initObservable: function () {
            this._super().observe('qty');

            return this;
        },

        getDataValidator: function() {
            return JSON.stringify(this.dataValidate);
        },

        getTitle: function() {
            return this.title;
        },

        getIncreaseImage: function() {
            return this.increaseImage;
        },

        getDecreaseImage: function() {
            return this.decreaseImage;
        },

        decreaseQty: function() {
            var qty;

            if (this.qty() > 1) {
                qty = this.qty() - 1;
            } else {
                qty = 1;
            }

            this.qty(qty);
        },

        increaseQty: function() {
            var qty = this.qty() + 1;

            this.qty(qty);
        }
    });
});
