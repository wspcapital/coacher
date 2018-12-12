<template>
    <div id="need-credits">
        <div v-show="step==0">
            <div v-if="type === 'session'">
                <h3>VIRTUAL COACHING SERVICES HAVE NOT BEEN PROVIDED.</h3>
                <a href="#" title="If you want to purchase Video Uploads, click Purchase Video Coaching."
                   class="btn btn-primary small variable" @click.prevent="setStep(1)">PURCHASE VIDEO COACHING</a>
            </div>
            <div v-if="type === 'video'">
                <h3>YOU HAVE NO ONLINE COACHING SESSIONS.</h3>
                <a href="#"
                   title="If you want to purchase Online Personal Coaching Sessions, click Purchase Virtual Coaching."
                   class="btn btn-primary small variable" @click.prevent="setStep(1)">PURCHASE VIRTUAL COACHING</a>
            </div>
        </div>

        <div v-show="step==1">
            <form class="form-inline" name="paymentForm" method="post" action="/portal/charge"
                  v-on:submit.prevent="pay">

                <h2>COACHING SESSION DETAILS</h2>

                <div class="clearfix" style="margin-bottom: 10px">
                    <div class="form-group">

                        <select class="form-control form-payment" v-model="currencyType" required>
                            <option v-for="(currency, type) in payments.currency" v-bind:value="type">
                                {{ type.toUpperCase() }}
                            </option>
                        </select>
                        CURRENCY
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom: 10px" ng-repeat="item in order.items">
                    <div class="form-group">
                        <input v-model="payments.count" class="form-control form-payment quantity" type="number" min="1"
                               required>
                        {{ payments.type.label }} @ {{ payments.currency[currencyType].symbol}}
                        {{ payments.type.price[currencyType] | currency }}
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" v-model="couponUse">
                                    Enter coupon code:</label>
                            </div>
                            <div class="form-group">
                                <input name="coupon" v-model="coupon.code" class="form-control"
                                       :disabled="!couponUse">
                                <button type="button" class="btn btn-primary"
                                        :disabled="!couponUse"
                                        v-on:click.prevent="applyCoupon()">
                                    Apply
                                </button>
                                <span class="text-success" v-show="coupon.type">
                                    <strong>{{ coupon.type | firstUC }}:</strong> -
                                    <span v-show="coupon.type=='discount'">
                                        {{ payments.currency[currencyType].symbol}} {{ discount }}
                                ({{ coupon.discount }}%)</span>
                                    <span v-show="coupon.type=='free'">
                                        {{ coupon.vcoaches }} Virtual Coach Videos and {{ coupon.sessions }} Coaching Session
                                    </span>
                                </span>
                                <span class="text-danger" v-show="coupon.error"> {{ coupon.error }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-grey">TOTAL: <span class="text-blue">
                    {{ this.payments.currency[this.currencyType].symbol }} {{ getTotal() | currency}}
                </span></h3>

                <p class="text-uppercase">Using video conferencing tools, your coach will provide live feedback to
                    address your concerns and other focal points.</p>
                <div class="clearfix">
                    <button type="button" class="btn btn-primary small pull-right" @click="setStep(0)">CANCEL</button>
                    <button type="submit" class="btn btn-primary small pull-right" @click="init()">PAY NOW</button>
                </div>
                <input type="hidden" name="user_id" v-model="user.id">

                <input type="hidden" id="type" name="items[0][type]" v-model="type">
                <input type="hidden" name="items[0][qty]" v-model="payments.count">
                <input type="hidden" name="currency" v-model="currencyType">
            </form>
        </div>
    </div>
</template>

<script>
    Vue.filter('currency', function (value) {
        return (value / 100).toFixed(2)
    });
    Vue.filter('firstUC', function (value) {
        if (!value) return value;

        return value[0].toUpperCase() + value.slice(1);
    });

    export default{
        data(){
            return {
                step: 0,
                couponUse: false,
                coupon: {
                    code: '',
                    type: '',
                    error: false,
                    discount: 0,
                    sessions: 0,
                    vcoaches: 0
                },
                currencyType: 'usd',
                payments: {
                    key: '',
                    type: {
                        price: {
                            usd: ''
                        }
                    },
                    count: 1,
                    price: '',
                    amount: 0,
                    currency: {
                        usd: {
                            symbol: ''
                        }
                    }
                },
                user: '',
            }
        },
        props: ['type'],
        computed: {
            // a computed getter
            discount: function () {
                // `this` points to the vm instance
                return ((this.payments.amount * (this.coupon.discount / 100)) / 100).toFixed(2);
            }
        },
        created() {
            this.getConfig();
        },
        methods: {
            getConfig() {
                this.$http.get(`/payments/getConfig?type=${this.type}`).then((response) => {
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
                this.payments.amount = this.payments.count * this.payments.type.price[this.currencyType];
                if (this.coupon.type == 'discount') {
                    return this.payments.amount - this.payments.amount * (this.coupon.discount / 100);
                } else {
                    return this.payments.amount;
                }
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
            applyCoupon() {
                this.$http.get(`/portal/applyCoupon?couponCode=${this.coupon.code}`).then(
                    function (data, status, request) {
                        this.coupon.error = false;
                        this.coupon.type = data.body.type;
                        this.coupon.discount = data.body.discount;
                        if (this.coupon.type == 'free') {
                            this.coupon.vcoaches = data.body.vcoaches;
                            this.coupon.sessions = data.body.sessions;
                        }
                        // this.getTotal();
                    }, function (error) {
                        this.coupon.error = error.body;
                    });
            },

            init() {
                let csrf_token = document.querySelector('#token').getAttribute('value');
                Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
                let form = $('form[name=paymentForm]');
                let csrfToken = document.querySelector('#token').getAttribute('value');
                let amount = this.getTotal();
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
                                form.append($('<input type="hidden" name="_token">').val(csrfToken));
                                form.append($('<input type="hidden" name="amount">').val(amount));
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

    }


</script>
