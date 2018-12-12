new Vue({
    el: '#logistics',
    data: {
        errors: {
            status: false,
            message: ''
        }
    },
    methods: {
        sendLogistics(e) {
            this.clearError();
            let data = new FormData();
            let element = $(e.target);
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());

            this.$http.post(`/intranet/bookings/logistics/send-logistics`, data).then((response) => {
                element.find('span').html('ReSend Logistics');
                $("#logisticsLinkModal").find(".modal-body").html(response.body.data.share_hash);
            }, (response) => {
                this.errors.status = true;
                this.errors.message = response.body.data;
            });
        },
        sendBooks(e) {
            this.clearError();
            let data = new FormData();
            let element = $(e.target);
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());

            this.$http.post(`/intranet/bookings/logistics/send-books`, data).then((response) => {
                element.find('span').html('ReSend Books');
        }, (response) => {
                this.errors.status = true;
                this.errors.message = response.body.data;
            });
        },
        clearError() {
            this.errors.status = false;
            this.errors.message = '';
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        getId() {
            let url = window.location.pathname;
            let id = url.split('/');
            return id[3];
        },
    }
});