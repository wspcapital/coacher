require('./../../../../../node_modules/printthis');

let vm = new Vue({
    el: "#participant",
    data: {
        newParticipant: {},
        participants: {},
        trainers: {},
        parts: {},
        errors: {
            status: false,
            message: ''
        }

    },
    created() {
        this.getParticipants();
    },
    methods: {
        getParticipants() {
            this.$http.get(`/intranet/bookings/participants/${this.getId()}`).then((response) => {
                //console.log(response);
                this.participants = response.body.participants;
                this.trainers = response.body.trainers;
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        addParticipant() {
            this.clearError();
            if (this.newParticipant.first_name && this.newParticipant.last_name && this.newParticipant.email) {
                let data = new FormData();
                data.append('_token', this.getToken());
                data.append('booking_id', this.getId());
                data.append('first_name', this.newParticipant.first_name);
                data.append('last_name', this.newParticipant.last_name);
                data.append('email', this.newParticipant.email);

                this.$http.post(`/intranet/bookings/participants/save`, data).then((response) => {
                    let new_participant = response.body;
                new_participant.data.ina = {'status':''};
                new_participant.data.account_sent = '';
                new_participant.share_hash = '';
                new_participant.data.ddp = {'status':'', 'notice_sent':'0'};
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
        getId() {
            let url = window.location.pathname;
            let id = url.split('/');
            return id[3];
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
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
        saveTrainer(participant) {
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('participant_id', participant.id);
            data.append('trainer_id', participant.user.trainerId);
            this.$http.post(`/intranet/bookings/participants/trainer/save`, data).then((response) => {

            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        blockNotify(participant) {
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('participant_id', participant.id);
            data.append('block_notify', participant.data.blockNotify);
            this.$http.post(`/intranet/bookings/participants/block-notify`, data).then((response) => {console.log(response.body.data);
                participant.data.blockNotify = response.body.data;
            }, (response) => {
                // error callback
                console.log('error')
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
        sendAllInas(e) {
            this.clearError();
            let data = new FormData();
            let element = $(e.target);
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-ina/all`, data).then((response) => {
                element.find('span').html('Resend all INAs');
            this.participants.forEach(function(participant){
                participant.data.ina.status = response.body.data[participant.id].status;
                participant.share_hash = response.body.data[participant.id].share_hash;
            });
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        sendINA(participant) {
            this.clearError(participant);
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-ina/`+participant.id, data).then((response) => {
                participant.data.ina=response.body.data;
                participant.share_hash = response.body.data.share_hash;
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        sendAccount(participant) {
            this.clearError(participant);
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-account/`+participant.id, data).then((response) => {
                participant.data.account_sent = response.body.data;
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        sendAllAccount(e) {
            this.clearError();
            let data = new FormData();
            let element = $(e.target);
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-account/all`, data).then((response) => {
                element.find('span').html('ReSend all Accounts');
                this.participants.forEach(function(participant){
                    participant.data.account_sent = response.body.data[participant.id];//'1';
                });
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        sendAllDDPs(e) {
            this.clearError();
            let data = new FormData();
            let element = $(e.target);
            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-ddp/all`, data).then((response) => {
                element.find('span').html('Resend all DDPs');
                this.participants.forEach(function(participant){
                    if(typeof response.body.data[participant.id] !== 'undefined') {
                        participant.data.ddp.notice_sent = response.body.data[participant.id].notice_sent;
                    }
                });
            }, (response) => {
                // error callback
                console.log('error')
            });
        },
        sendDDP(participant) {
            this.clearError();
            let data = new FormData();

            data.append('_token', this.getToken());
            data.append('booking_id', this.getId());
            this.$http.post(`/intranet/bookings/participants/send-ddp/` + participant.id, data).then((response) => {
                participant.data.ddp.notice_sent = response.body.data.notice_sent;
        }, (response) => {
                // error callback
                console.log('error')
            });
        },
        upload(participant) {
            this.saveStatus = true;
            this.progress = 50;
            let token = this.getToken();
            let files = $("#ddp-file-" + participant.id)[0].files[0];
            let data = new FormData();
            data.append('file', files);
            data.append('_token', token);
            data.append('id', participant.id);
            //if(files.length)
            //{
                this.$http.post(`/intranet/bookings/ddp-file/upload`, data).then(
                    function (data, status, request) {
                        participant.data.ddp = data.body.data;//'uploaded';jQuery.parseJSON
                    }, function (error) {
                        console.log('error')
                    });
            //}

        }
    }
});

$(function () {
    $("#print-inas").on('click', function(){
        $("#printParticipantsInasModal").modal('show');
    });

    $("#all-inas-list").bind('click', function(){
        $(".all-ina").show();
    });

    $("#my-inas-list").bind('click', function(){
        $(".all-ina").hide();
    });

    $("#print-inas-list").bind('click', function(){
        $('#printParticipants').printThis();
    });

    $("#popupModal").on('show.bs.modal', function(e){
        $("#popupModalLabel").html($(e.relatedTarget).data('title'));
        let self = $(this);
        let url =$(e.relatedTarget).data('content')[0] + '/';
        self.find(".modal-body").html('');
        $.get("/intranet/bookings/participants/ina-share-hash/" + $(e.relatedTarget).data('content')[1], function(data){
            self.find(".modal-body").html('<a target="_blank" href="' + url + data.data + '">' + url + data.data + '</a>');
        }).fail(function(){
            console.log('error');
        });

    });

    $("#ina-modal").on('shown.bs.modal', function(e){

        if(typeof $(e.relatedTarget).data('content') !== 'undefined')
        {
            $("#client_role_duts").html($(e.relatedTarget).data('content').client_role_duts);
            $("#audiens_senior").prop("checked",$(e.relatedTarget).data('content').audiens_senior);
            $("#audiens_team").prop("checked",$(e.relatedTarget).data('content').audiens_team);
            $("#audiens_clients").prop("checked",$(e.relatedTarget).data('content').audiens_clients);
            $("#audiens_stakeholders").prop("checked",$(e.relatedTarget).data('content').audiens_stakeholders);
            $("#audiens_peers").prop("checked",$(e.relatedTarget).data('content').audiens_peers);
            $("#audiens_other").html($(e.relatedTarget).data('content').audiens_other);
            $("#audiens_subordinates").prop("checked",$(e.relatedTarget).data('content').audiens_subordinates);
            $("#audiens_media").prop("checked",$(e.relatedTarget).data('content').audiens_media);
            $("#audiens_community").prop("checked",$(e.relatedTarget).data('content').audiens_community);
            $("#audiens_students").prop("checked",$(e.relatedTarget).data('content').audiens_students);
            $("#skills_nervos").prop("checked",$(e.relatedTarget).data('content').skills_nervos);
            $("#skills_off_track").prop("checked",$(e.relatedTarget).data('content').skills_off_track);
            $("#skills_enthusiasm").prop("checked",$(e.relatedTarget).data('content').skills_enthusiasm);
            $("#skills_is_not_clear").prop("checked",$(e.relatedTarget).data('content').skills_is_not_clear);
            $("#skills_intimidating").prop("checked",$(e.relatedTarget).data('content').skills_intimidating);
            $("#skills_confidence").prop("checked",$(e.relatedTarget).data('content').skills_confidence);
            $("#skills_concise").prop("checked",$(e.relatedTarget).data('content').skills_concise);
            $("#skills_other").html($(e.relatedTarget).data('content').skills_other);
            $("#skills_compelling").prop("checked",$(e.relatedTarget).data('content').skills_compelling);
            $("#skills_too_fast").prop("checked",$(e.relatedTarget).data('content').skills_too_fast);
            $("#skills_monotone").prop("checked",$(e.relatedTarget).data('content').skills_monotone);
            $("#skills_viruses").prop("checked",$(e.relatedTarget).data('content').skills_viruses);
            $("#skills_questions").prop("checked",$(e.relatedTarget).data('content').skills_questions);
            $("#skills_language").prop("checked",$(e.relatedTarget).data('content').skills_language);
            $("#message_presentations").prop("checked",$(e.relatedTarget).data('content').message_presentations);
            $("#message_running_meetings").prop("checked",$(e.relatedTarget).data('content').message_running_meetings);
            $("#message_web_meetings").prop("checked",$(e.relatedTarget).data('content').message_web_meetings);
            $("#message_pitches").prop("checked",$(e.relatedTarget).data('content').message_pitches);
            $("#message_conversations").prop("checked",$(e.relatedTarget).data('content').message_conversations);
            $("#message_reviews").prop("checked",$(e.relatedTarget).data('content').message_reviews);
            $("#training_other").html($(e.relatedTarget).data('content').training_other);
        }
    });
})