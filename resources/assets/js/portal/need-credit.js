Vue.filter('currency', function (value) {
    return (value / 100).toFixed(2)
});

new Vue({
    el: '#need-credits',
    data: {
        step: 0,
        currencyType: 'usd',
        payments: {
            key: '',
            type: 'Session',
            count: 1,
            price: '',
            amount: 0,
            currency: ''
        },
        user: '',
        description: 'sssasd'
    },
    created() {
        this.getConfig();
    },
    methods: {
        getConfig() {
            let type = $("#type").val();
            this.$http.get(`/payments/getConfig?type=${type}`).then((response) => {
                let res = JSON.parse(response.body);
                this.payments.type = JSON.parse(res.type);
                this.payments.currency = JSON.parse(res.currency);
                this.payments.key = res.key;
                this.user = res.user;

            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        getPrice(event) {
            return `${this.payments.currency[this.currencyType].symbol} ${this.convert()}.00`
        },
        setStep(newStep) {
            this.step = newStep;
        },
        getTotal() {
            this.payments.amount =  this.payments.count * this.payments.type.price[this.currencyType] ;
            return this.payments.amount;
        },
        printTotal() {
          return `${this.payments.currency[this.currencyType].symbol} ${this.payments.count * this.convert()}.00`
        },
        /* cents in the dollar */
        convert() {
            return `${(this.payments.type.price[this.currencyType] / 100)}`;
        },
        getDescription() {
                let descriptions = this.payments.type.description.split('|');
                return descriptions[this.payments.count == 1 ? 0 : 1].replace(':qty', this.payments.count);
        },
        pay() {
            if (this.getTotal() <= 0) {
                $window.alert('Please, select at least one item for purchase.');
            }
            if (typeof this.checkoutPopup == 'object') {
                this.payInProgress = true;
                this.paymentError = null;
                // Open Checkout with further options
                this.checkoutPopup.open({
                    name: 'Pinnacle Performance, Inc.',
                    description: this.getDescription(),
                    amount: this.getTotal(),
                    currency: this.currencyType,
                    email: this.user.email
                });
            }
        },
        init() {
            let form = $('form[name=paymentForm]');
            if (window.StripeCheckout) {
                var tokenReceived = false;
                this.checkoutPopup = window.StripeCheckout.configure({
                    key: this.payments.key,
                    image: '/assets/dist/img/portal/checkout-logo.png', //'http://i.imgur.com/qtBr5Wc.png',
                    //locale: 'auto',
                    allowRememberMe: false,
                    token: function (token) {
                        // Use the token to create the charge with a server-side script.
                        // You can access the token ID with `token.id`
                        if (token.error) {
                            console.log(token.error.message);
                            // Show the errors on the form
                            this.paymentError = token.error.message;
                            $scope.$digest();
                        } else {
                            tokenReceived = true;
                            // response contains id and card, which contains additional card details
                            var token_id = token.id;
                            // Insert the token into the form so it gets submitted to the server
                            form.append($('<input type="hidden" name="stripeToken">').val(token_id));
                            // and submit
                            form.get(0).submit();
                        }
                    },
                    closed: function () {
                        //console.log('closed');
                        if (!tokenReceived) {
                            this.payInProgress = false;
                            /*$scope.$digest();*/
                        }
                    }
                });
            }
        },

    }
});
/*
 $scope.pay = function (e) {
 e.preventDefault();
 if ($scope.order.useCoupon && $scope.order.coupon.code && !$scope.order.coupon.type) {
 $scope.order.coupon.error = 'Please, click "Apply" to verify the code or uncheck the checkbox';
 return;
 }
 if ($scope.getAmount() <= 0) {
 $window.alert('Please, select at least one item for purchase.');
 return;
 }
 if (typeof $scope.checkoutPopup == 'object') {
 $scope.payInProgress = true;
 $scope.paymentError = null;
 // Open Checkout with further options
 $scope.checkoutPopup.open({
 name: 'Pinnacle Performance, Inc.',
 description: $scope.getDescription(),
 amount: $scope.getAmount(),
 currency: $scope.order.currency,
 email: $scope.order.email
 });
 }
 };*/

