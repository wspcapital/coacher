require('./../responsive-table');

new Vue({
    el: '#coupons',
    data: {
        formType: 1,
        couponsTypes: [
            {text: 'Select coupons type', value: '1'},
            {text: 'Discount', value: 'discount'},
            {text: 'Free', value: 'free'}
        ]
    },

});