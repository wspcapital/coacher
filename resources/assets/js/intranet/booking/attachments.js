let vm = new Vue({
    el: '#attachment',
    data: {
        allFiles: {},
        path: '/storage/upload/booking/',
        progress: 0,
        hideProgress: true,
        saveStatus: false,
        errorUploadFile: false,
        errors: {}
    },
    created() {
        this.init();
    },
    computed: {
        progressWidth: function () {
            return "width:" + this.progress + "%";
        }
    },
    methods: {
        init() {
            this.$http.get(`/intranet/bookings/getFile?bookingId=${this.getBookingId() }`).then (
                function (data, status, request) {
                   // console.log(data.body);
                    this.allFiles = data.body.data;
                },  function (error) {
                    console.log('error');
            });
        },
        upload() {
            this.disabled();
            this.hideProgress = false;
            this.saveStatus = true;
            let token = this.getToken();
            let files = $('#booking-file')[0].files[0];
            let data = new FormData();
            data.append('file', files);
            data.append('_token', token);
            data.append('booking_id', this.getBookingId());
            let self = this;
            $.ajax({
                url: '/intranet/bookings/file/upload',
                type: 'post',
                contentType: false,
                processData: false,
                data: data,
                dataType: 'json',
                xhr: function () {
                    let xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
                    xhr.upload.addEventListener('progress', function (evt) { // добавляем обработчик события progress (onprogress)
                        if (evt.lengthComputable) { // если известно количество байт
                            // высчитываем процент загруженного
                            let percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                            // устанавливаем значение в атрибут value тега <progress>
                            self.progress = percentComplete;
                            if (percentComplete == 100) {
                                self.loader = true;
                                setTimeout(function () {
                                    self.progress = 0;
                                    self.hideProgress = true;
                                }, 1000);
                            }
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    self.hideProgress = true;
                    self.orderAssetsId = data;
                    self.allFiles.push(data);
                    self.undisabled();
                },
                error: function (error) {
                    self.hideProgress = true;
                    self.errorUploadFile = true;
                    self.errors = JSON.parse(error.responseText).video;
                    self.undisabled();
                }
            });
        },
        disabled() {
            $('#booking-file').attr("disabled", "disabled");
            $('#buttonUpload').attr("disabled", "disabled");
        },
        undisabled() {
            $('#booking-file').removeAttr("disabled");
            $('#buttonUpload').removeAttr("disabled");
        },

        deleteFile(id) {
            this.allFiles.forEach(function (item, i, arr) {
                if (id == item.assets.id) {
                    vm.$http.get(`/intranet/bookings/deleteFile/${id}`).then((response) => {
                        vm.allFiles.splice(i, 1);
                    }, (response) => {
                        // error callback
                        console.log('error')
                    });
                }
            });
        },

        deleteAllFile() {
                    this.$http.get(`/intranet/bookings/deleteAllFile?bookingId=${vm.getBookingId()}`).then((response) => {
                       this.allFiles = {};
                    }, (response) => {
                        // error callback
                        console.log('error')
                    });

        },

        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        getBookingId() {
            let path = location.pathname.slice(1);
            let urlArray = path.split('/');
            return urlArray[urlArray.length - 1];
        },

    }
});