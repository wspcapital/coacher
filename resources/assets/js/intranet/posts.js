require('./../responsive-table');

new Vue({
    el: '#app-posts',
    data: {
        posts: [],
        loading: false,
        error: false,
        query: '',
        test: '',
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
                   this.$http.get(`/intranet/api-posts?page=${page}`).then((response) => {
                       this.posts = [];
                       this.posts = response.body.data;
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

        search() {
            // Clear the error message.
            this.error = '';
            // Empty the products array so we can fill it with the new products.
            this.posts = [];
            // Set the loading property to true, this will display the "Searching..." button.
            this.loading = true;

            // Making a get request to our API and passing the query to it.
            this.$http.get('/api/search?q=' + this.query).then((response) => {
                // If there was an error set the error message, if not fill the products array.
                response.body.error ? this.error = response.body.error : this.posts = response.body.data;
                this.renderPagination(response.body);
                // The request is finished, change the loading to false again.
                this.loading = false;
                // Clear the query.
                this.query = '';
                console.log(this.posts);
            });
        }
    }
});
