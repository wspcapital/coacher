<template>
    <div>
        <div>
            <div id="learning-video-player">
                <video src="" controls hidden></video>
            </div>
            <p><strong>Learning Videos</strong></p>
            <table class="table">
                <thead>
                <tr>
                    <th>Filename</th>
                    <th>Uploaded</th>
                    <th>Lesson</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(video, index) in videos" v-bind:id="video.asset.id">
                    <td class="video">
                        <a @click.prevent="getUrl(video.asset.id, video.asset.media[0].file_name)">
                            {{ video.asset.media[0].file_name }}
                        </a>
                    </td>
                    <td>{{ video.created_at | formatDate}}</td>

                    <td>
                        <select class="form-control" v-model="video.title" @change="changeSaveStatus">
                            <option v-for="option in options" v-bind:value="option">
                                {{ option }}
                            </option>
                        </select>
                    </td>
                    <td class="filename">
                        <a v-bind:href="path + video.asset.id + '/' + video.asset.media[0].file_name+'?fdl=1'" download>download</a>
                        |
                        <a href="#" @click.prevent="deleteVideo(video.asset.id, index)">delete</a> |
                        <input type="file" accept="application/pdf" @change="uploadPdf(video)" name="pdf" v-bind:id="'learning-file' + video.id"
                               class="inputfile"/>
                        <label v-bind:for="'learning-file' + video.id">Addpdf</label> |
                        <a v-if="video.asset.get_doc_videos" target="_blank"
                           v-bind:href="filePath + video.asset.get_doc_videos.doc_assets.id + '/' + video.asset.get_doc_videos.doc_assets.media[0].file_name">
                            {{ video.asset.get_doc_videos.doc_assets.media[0].file_name }} |
                        </a>
                        <a v-bind:href="'/intranet/shared-video/'+video.id">Shared</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="progress" v-if="!hideProgress">
                <div class="progress-bar progress-bar-warning" role="progressbar"
                     aria-valuemin="0"
                     aria-valuemax="100" :style="progressWidth">
                </div>
            </div>
            <div class="alert alert-danger" v-if="errorUploadFile">
                <div v-for="error in errors">
                    <strong>Error!</strong> {{ error }}
                </div>
            </div>
            <div class="alert alert-success" role="alert" id="learning-title">
                {{ savedMessage }}
            </div>
            <div class="clearfix">
                <div v-show="saveStatus" class="btn  btn-primary  pull-right" @click="saveWorkshops(videos)">
                    Save
                </div>
                <input type="file" accept="video/avi,video/mpeg,video/quicktime,video/mp4" @change="upload" name="video" id="learning-videos" class="inputfile"/>
                <label class="btn btn-primary variable" id="learningButtonUpload" for="learning-videos">Browse</label>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                videos: [],
                progress: 0,
                hideProgress: true,
                saveStatus: false,
                errorUploadFile: false,
                userId: '',
                path: '/storage/upload/video/',
                filePath: '/storage/upload/videoDoc/',
                errors: [],
                options: [],
                savedMessage: ''
            }
        },
        computed: {
            progressWidth: function () {
                return "width:" + this.progress + "%";
            }
        },
        created() {
            this.getUserId();
            this.init();
        },
        methods: {
            init() {
                this.$http.get(`/intranet/learning-videos/get/${this.userId}`).then(
                    function (data, status, request) {
                        this.videos = data.body.videos;
                        this.options = data.body.titles;
                    }, function (error) {
                        console.log('error');
                    });
            },
            getUserId() {
                let path = location.pathname.slice(1);
                let urlArray = path.split('/');
                this.userId = urlArray[urlArray.length - 1];
            },
            getToken() {
                return document.querySelector('#token').getAttribute('value');
            },
            upload() {
                this.hideProgress = false;
                let token = this.getToken();
                this.disabled(); //// disabled button
                let files = $('#learning-videos')[0].files[0];
                let data = new FormData();
                data.append('video', files);
                data.append('_token', token);
                data.append('user_id', this.userId);
                let self = this;
                $.ajax({
                    url: '/intranet/learning-videos/upload',
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
                                    setTimeout(function () {
                                        self.progress = 0;
                                        self.hideProgress = true;
                                    }, 1000);
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        console.log(response);
                        self.hideProgress = true;
                        self.videos = response.data;
                        self.savedMessage = response.message;
                        self.saveMessage();
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
                $('#learningButtonUpload').attr("disabled", "disabled");
                $('#video').attr("disabled", "disabled");
            },
            undisabled() {
                $('#learningButtonUpload').removeAttr("disabled");
                $('#video').removeAttr("disabled");
            },
            deleteVideo(id, index) {
                this.$http.get(`/intranet/videos/delete/${id}`).then(
                    function (data, status, request) {
                        this.videos.splice(index, 1);
                    }, function (error) {
                        this.errorUploadFile = true;
                        this.errors = ['No delete'];
                    });
            },
            saveWorkshops(videos) {
                let data = new FormData();
                data.append('data', JSON.stringify(this.videos));
                data.append('_token', this.getToken());
                this.$http.post('/intranet/workshop-videos/save', data).then(
                    function (data, status, request) {
                        this.savedMessage = data.body.message;
                        this.saveMessage();
                    }, function (error) {
                        this.saveStatus = false;
                            this.progress = 0;
                        this.errors = error.body.video;
                        this.errorUploadFile = true;
                    });
            },
            changeSaveStatus() {
                this.saveStatus = true;
            },
            saveMessage() {
                this.saveStatus = false;
                $('#learning-title').slideDown();
                setTimeout(function () {
                    $('#learning-title').slideUp();
                }, 1500);
            },
            getUrl(id, fileName) {
                $('#learning-video-player > video').attr('src', `${this.path}${id}/${fileName}`)
                    .attr('width', '640px').attr('height', '400px').show();
            },
            uploadPdf(video) {
                this.saveStatus = false;
                let token = this.getToken();
                let files = $(`#learning-file${video.id}`)[0].files[0];
                let data = new FormData();
                data.append('pdf', files);
                data.append('_token', token);
                let self = this;
                data.append('asset_id', video.asset_id);
                $.ajax({
                    url: '/intranet/videos/file/upload',
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
                                    setTimeout(function () {
                                        self.progress = 0;
                                        self.hideProgress = true;
                                    }, 1000);
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        console.log(response);
                        self.saveStatus = false;
                        self.hideProgress = true;
                        video.asset.get_doc_videos = {doc_assets: {media: response.data}};
                        self.savedMessage = response.message;
                        self.saveMessage();
                        self.undisabled();
                    },
                    error: function (error) {
                        self.saveStatus = false;
                        self.hideProgress = true;
                        self.errorUploadFile = true;
                        self.errors = JSON.parse(error.responseText).video;
                        self.undisabled();
                    }
                });
            }
        }
    }


</script>
