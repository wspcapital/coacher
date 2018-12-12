new Vue({
    el: '#shared-video',
    data: {
        video: false,
        filePath: '/storage/upload/videoDoc/',
        participants: [],
        email: '',
        bookingId: '',
        errorStatus: false,
        errors: []
    },
    created() {
      this.getVideo();
    },
    methods: {
        getVideo() {
            this.$http.get(`/intranet/get-shared-video?userAssetId=${this.getUserAssetId()}`).then(
                function (data, status, request) {
                    this.video = data.body.video;
                    this.participants = data.body.participant;
                    /*this.videos = data.body.videos;
                    this.options = data.body.titles;*/
                }, function (error) {
                    console.log('error');
                });
        },
        getUserAssetId() {
            let path = location.pathname.slice(1);
            let urlArray = path.split('/');
            return urlArray[urlArray.length - 1];
        },
        emailParticipant() {
            this.errorStatus = false;
            this.errors = '';
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('email', this.email);
            data.append('assetId', this.video.asset_id);
            this.$http.post('/intranet/add-participant/email', data).then(
                function (data, status, request) {
                    this.participants = data.body;
                    this.email = '';
                }, function (error) {
                    this.errorStatus = true;
                    this.errors = error.body;
                });
        },
        bookingParticipant() {
            this.errorStatus = false;
            this.errors = '';
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('booking_id', this.bookingId);
            data.append('assetId', this.video.asset_id);
            this.$http.post('/intranet/add-participant/booking', data).then(
                function (data, status, request) {
                    this.participants = data.body;
                    this.bookingId = '';
                }, function (error) {
                    this.errorStatus = true;
                    this.errors = error.body;
                });
        },
        delParticipant(participantId) {
            this.errorStatus = false;
            this.errors = '';
            let data = new FormData();
            data.append('_token', this.getToken());
            data.append('user_id', participantId);
            data.append('asset_id', this.video.asset_id);
            this.$http.post('/intranet/del-participant', data).then(
                function (data, status, request) {
                    console.log(data.body);
                    $(`#part${participantId}`).hide();
                    //this.participants = data.body;
                    //this.bookingId = '';
                }, function (error) {
                    this.errorStatus = true;
                    this.errors = {error: [error.body]};
                });
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
    }
});