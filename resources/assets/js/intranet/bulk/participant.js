let vm = new Vue({
    el: "#participant",
    data: {
        newParticipant: {},
        participants: {},
        errors: {
            status: false,
            message: ''
        }
        //sessions_use: 0,
        //vcoaches_use: 0
    },
    created() {
        this.getParticipants();
    },
    methods: {
        getParticipants() {
            this.$http.get(`/intranet/bulks/participants?id=${this.getId()}`).then((response) => {
                this.participants = response.body.participants;
                let sessions_assign = 0;
                let vcoaches_assign = 0;

                let sessions_use = 0;
                let vcoaches_use = 0;

                this.participants.forEach(function(par){
                    sessions_assign += par.user.sessions;
                    vcoaches_assign += par.user.vcoaches;
                    par.orders.forEach(function(order){
                       if(order.type == 'Session')
                       {
                           sessions_use++;
                       }
                       else if(order.type == 'Video')
                       {
                           vcoaches_use++;
                       }
                    });
                });

            $("#sessions_assign").html(sessions_assign);
            $("#vcoaches_assign").html(vcoaches_assign);

            $("#sessions_use").html(sessions_use);
            $("#vcoaches_use").html(vcoaches_use);

            $("#sessions_balance").html(parseInt($("[name='sessions']").val()) - sessions_assign);
            $("#vcoaches_balance").html(parseInt($("[name='vcoaches']").val()) - vcoaches_assign);
            }, (response) => {
                console.log('error')
            });
        },
        addParticipant()
        {
            this.clearError();
            if (this.newParticipant.first_name && this.newParticipant.last_name && this.newParticipant.email) {
                let data = new FormData();
                data.append('_token', this.getToken());
                data.append('booking_id', this.getId());
                data.append('first_name', this.newParticipant.first_name);
                data.append('last_name', this.newParticipant.last_name);
                data.append('email', this.newParticipant.email);

                this.$http.post(`/intranet/bookings/participants/save`, data).then((response) => {
                    this.participants.push(response.body);
                    this.newParticipant = {};
                }, (response) => {
                    this.errors.status = true;
                    this.errors.message = response.body.email[0];
                });
            }
            else {
                this.errors.status = true;
                this.errors.message = "Please, fill in form fields and push the button «Add participant».";
            }
        },
        getId() {
            let url = window.location.pathname;
            let id = url.split('/');
            return id[3];
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        saveVCoaches(user) {
            this.clearError();
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            data.append('user_id', user.id);
            data.append('vcoaches', user.vcoaches);

            this.$http.post(`/intranet/bookings/participants/vcoach`, data).then((response) => {

            }, (response) => {
                this.errors.status = true;
                this.errors.message = response.body;
            });
        },
        saveSessions(user) {
            this.clearError();
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            data.append('user_id', user.id);
            data.append('sessions', user.sessions);

            this.$http.post(`/intranet/bookings/participants/session`, data).then((response) => {
            }, (response) => {
                this.errors.status = true;
                this.errors.message = response.body;
            });
        },
        deleteParticipant(id) {
            this.participants.forEach(function (item, i, arr) {
                if (id == item.user.id) {
                    vm.$http.get(`/intranet/bookings/participants/delete?user_id=${id}&booking_id=${vm.getId()}`).then((response) => {
                        vm.participants.splice(i, 1);
                    }, (response) => {
                        // error callback
                        console.log('error')
                    });
                }
            });
        },
        confirmDelete(id) {
            if (confirm("Are you shure?")) {
                this.deleteParticipant(id);
            } else {
                e.preventDefault();
            }
        },
        clearError() {
            this.errors.status = false;
            this.errors.message = '';
        },
        postNotify(id) {
            this.clearError();
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bulks/participants/notify/` + id, data).then((response) => {

            }, (response) => {
                // error callback
                console.log('error')
            });
        }
    }
});