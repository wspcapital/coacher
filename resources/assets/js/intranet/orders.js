require('./../responsive-table');

import moment from 'moment'

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YY')
    }
});

new Vue({
    el: '#app-orders',
    data: {
        orders: [],
        loading: false,
        error: false,
        query: '',
        sortable: {
            key: 'id',
            type: 'asc'
        },
        changeStatus: true,
        pagination: {
            countPage: '1',
            currentPage: 1,
            nexPage: '',
            prevPage: '1',
            nextPageClass: '',
            prevPageClass: '',
        },
        orderStatus: {
            '-1': "Unsubmitted",
            '0': 'Activated',
            '1': 'Assigned',
            '2': 'Date Set',
            '3': 'Completed'
        },
        trainers: [],
        active: true
    },
    created() {
        this.fetchMessages();
    },

    methods: {
        fetchMessages(status = 'new', page = 1) {
            this.changeStatus = false;
            this.stated = status;
            this.$http.get(`/intranet/allOrders/${this.sortable.key}/${this.sortable.type}/?status=${status}&page=${page}`).then((response) => {
                this.orders = [];
                this.orders = response.body.orders.data;
                this.trainers = response.body.trainers;
                this.renderPagination(response.body.orders);
                let self = this;
                /////  fix change error
                setTimeout(function () {
                    self.changeStatus = true;
                }, 500);
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        renderPagination(body) {
            this.pagination.prevPageClass = true;
            this.pagination.nextPageClass = true;
            this.pagination.countPage = body.last_page;
            this.pagination.currentPage = body.current_page;
            if (body.next_page_url != null) {
                this.pagination.nextPage = body.current_page + 1;
            }
            else {
                this.pagination.nextPageClass = false;
            }
            if (body.prev_page_url != null) {
                this.pagination.prevPage = body.current_page - 1;
            }
            else {
                this.pagination.prevPageClass = false;
            }
        },
        sort(key) {
            this.sortable.key = key;
            if(this.sortable.type == 'asc') {
                this.sortable.type = 'desc';
            } else {
                this.sortable.type = 'asc'
            }
            this.fetchMessages();
        },

        search() {
            this.changeStatus = false;
            // Clear the error message.
            this.error = '';
            // Empty the products array so we can fill it with the new products.
            this.posts = [];
            // Set the loading property to true, this will display the "Searching..." button.
            this.loading = true;
            // Making a get request to our API and passing the query to it.
            this.$http.get('/intranet/orders/search?q=' + this.query).then((response) => {
                this.orders = [];
                this.orders = response.body.orders.data;
                this.trainers = response.body.trainers;
                let self = this;
                /////  fix change error
                setTimeout(function () {
                    self.changeStatus = true;
                }, 500);
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        saveTrainer(order) {
            if (this.changeStatus) {
                let data = new FormData();
                data.append('_token', this.getToken());
                data.append('order_id', order.id);
                data.append('order_trainer_id', order.order_trainer_id);
                this.$http.post(`/intranet/orders/trainer/save/${order.id}`, data).then((response) => {
                    order.beforeTrainer = response.body;
                }, (response) => {
                    // error callback
                    console.log('error')
                });
            }
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        confirmDelete(id) {
            if (confirm("Are you shure?")) {
                this.deleteOrder(id);
            }
        },
        deleteOrder(orderId) {
            this.$http.get(`/intranet/orders/delete?orderId=${orderId}`).then((response) => {
                $(`#order${orderId}`).hide();
            }, (response) => {
                // error callback
                console.log('error')
            });
        }
    }
});
