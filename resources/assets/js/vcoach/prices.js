
new Vue({
    el: '#app',
    data: {
        currencyType: 'usd',
        currency: '',
        video: '',
        session: '',
        packages: '',
        countPackage: 0,
        countSession: 0
    },
    created() {
        this.init()
    },
    methods: {
        init() {
            this.$http.get(`/payments/vcoach/config`).then((response) => {
                this.currency = JSON.parse(response.body.currency);
                this.video = response.body.payments.video;
                this.session = response.body.payments.session;
                this.packages = response.body.payments.package_1;
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        getCurrency(price) {
            return (price / 100).toFixed(2)
        },
        getPrice(price) {
            return `${this.currency[this.currencyType].symbol} ${this.getCurrency(price)}`;
        },
        getTotal() {
            let total = this.packages.price[this.currencyType] * this.countPackage
                + this.session.price[this.currencyType] * this.countSession;
            return this.getPrice(total);
        }
    }
});