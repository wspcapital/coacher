require('./../responsive-table');

new Vue({
    el: '#app-bulks',
    data: {
        bulks: [],
        loading: false,
        error: false,
        query: '',
        pagination: {
            countPage: '2',
            currentPage: 1,
            nexPage: '',
            prevPage: '1',
            nextPageClass: '',
            prevPageClass: ''
        },
        active: true
    },
    created() {
        this.fetchMessages();
    },

    methods: {
        fetchMessages(page = 1) {
            if(this.query == '') {
                this.getBulks(page)
            } else {
                this.search(page)
            }
        },
        getBulks(page) {
            this.$http.get(`/intranet/bulkslist?page=${page}`).then((response) => {
                this.bulks = [];
                this.bulks = response.body.data;
                this.renderPagination(response.body);
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

        search(page) {
            this.error = '';
            this.bulks = [];
            this.$http.get(`/intranet/bulks/search?q=${this.query}&page=${page}`).then((response) => {
                response.body.error ? this.error = response.body.error : this.bulks = response.body.data;
                this.renderPagination(response.body);
                this.loading = false;
            });
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        confirmDelete(id) {
            if (confirm("Are you shure?")) {
                this.deleteBulk(id);
            }
        },
        deleteBulk(bulkId) {
            this.$http.get(`/intranet/bulks/delete?Id=${bulkId}`).then((response) => {
                $(`#order${bulkId}`).hide();
            }, (response) => {
                // error callback
                console.log('error')
            });
        }
    }
});
