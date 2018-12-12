new Vue({
    el: '#trainers',
    data: {
        r: ''
    },
    methods: {
        deleteTrainer(id) {
            this.$http.get(`/intranet/bookings/trainer/delete/${id}`).then((response) => {
                let userId = response.body;
                $(`#trainer-${id}`).hide();
                $(`input[value=${userId}]`).removeAttr("checked");
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        confirmDelete(id) {
            if (confirm("Are you shure?")) {
                this.deleteTrainer(id);
            } else {
                e.preventDefault();
            }
        },

    }
});