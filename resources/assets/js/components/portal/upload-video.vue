<template>
    <div>
        <div v-show="step === 0">
            <input type="file" accept="video/avi,video/mpeg,video/quicktime,video/mp4" @change="upload" name="video"
                   id="video" class="inputfile"/>
            <label class="btn btn-primary btn-border small variable" id="buttonUpload" for="video">
                {{ $t('upload.button') }}
            </label>

            <a href="#" id="faq" class="btn  btn-primary btn-border small" data-toggle="modal"
               data-target="#faq-modal">?</a>
            <div class="col-xs-12">
                <small> {{ $t('upload.small') }}</small>
            </div>
        </div>
        <div class="col-xs-6">
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
            <div class="loader" v-show="loader">
                <img src="/assets/dist/img/loader.gif" alt="loader">
            </div>
        </div>
        <div class="row" v-show="step === 1">
            <div class="col-xs-12">
                <form method="post" action="/portal/my-videos/save" id="userForm1" @submit.prevent="submitForm">
                    <input type="hidden" name="orderAssetId" v-model="orderAssetsId">
                    <div class="form-group">
                        <label for="workshop"> {{ $t('form.workshop') }}</label>
                        <input type="checkbox" id="workshop" name="workshop" value="1">
                    </div>

                    <div class="form-group">
                        <label for="title"> {{ $t('form.title') }} </label>
                        <input id="title" type="text" name="title" class="form-control" v-model.trim="form.title" required>
                        <div class="alert alert-danger" v-if="formValidation.title">
                                <strong>Error!</strong> Field is required !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="whoisfor"> {{ $t('form.whoisfor') }} </label>
                        <textarea id="whoisfor" v-model.trim="form.whoisfor" name="whoisfor" class="form-control" rows="3" cols="30" required>
                        </textarea>
                        <div class="alert alert-danger" v-if="formValidation.whoisfor">
                            <strong>Error!</strong> Field is required !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="challenge"> {{ $t('form.challenge') }} </label>
                        <textarea id="challenge" name="challenge" class="form-control" rows="3" cols="30">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="takeaway"> {{ $t('form.takeaway') }} </label>
                        <textarea id="takeaway" v-model.trim="form.takeaway" name="takeaway" class="form-control" rows="3" cols="30" required>
                        </textarea>
                        <div class="alert alert-danger" v-if="formValidation.takeaway">
                            <strong>Error!</strong> Field is required !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="react"> {{ $t('form.react') }} </label>
                        <textarea id="react" v-model.trim="form.react" name="react" class="form-control" rows="3" cols="30" required>
                        </textarea>
                        <div class="alert alert-danger" v-if="formValidation.react">
                            <strong>Error!</strong> Field is required !
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="misc"> {{ $t('form.misc') }} </label>
                            <textarea id="misc" v-model.trim="form.misc" name="misc" class="form-control" rows="3" cols="30" required>
                            </textarea>
                            <div class="alert alert-danger" v-if="formValidation.misc">
                                <strong>Error!</strong> Field is required !
                            </div>
                        </div>
                    </div>
                    <div class=" col-xs-12 clearfix">
                        <button type="submit" class="btn btn-primary pull-right btn-lg"> {{ $t('form.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import VueI18n from 'vue-i18n';

    // ready translated locales
    let locales = {
        en: {
            upload: {
                // button:    Lang.get('portal/my-videos.uploadVideo'),
                button: 'Upload Virtual Coach Video',
                small: `Videos should be approximately 5 minutes long. Make sure your video is recorded in an acceptable
                        format: video/avi, video/mpeg, video/quicktime, video/mp4`,
                error: `Upload error. Refresh the page and try again, or
                        <a href="mailto:vcoach@pinper.com">contact us</a> for help.`
            },
            form: {
                workshop: 'Check here if you attended a live Pinnacle Workshop. ',
                title: 'Title of your video. *',
                whoisfor: 'Describe the audience for whom this message is to be delivered. *',
                challenge: 'What challenge stands in the way of this audience understanding and acting on your message?',
                takeaway: 'What are the key takeaways you want them to absorb from your message? *',
                react: 'What is the behavior or reaction you wish to induce from your audience? *',
                misc: `Please provide any additional background information or comments about your
                       material, audience, forum or desired outcomes that may be helpful for your coach. * `,
                submit: 'Save'

            }
        },
        ja: {
            form: {
                workshop: 'C3123221423432 fdfsdf 3. *'
            }
        }
    };

    // set lang
    Vue.config.lang = 'en';

    // set locales
    Object.keys(locales).forEach(function (lang) {
        Vue.locale(lang, locales[lang])
    });

    export default {
        data(){
            return {
                progress: 0,
                loader: false,
                hideProgress: false,
                errorUploadFile: false,
                videoUpload: false,
                disabledButton: false,
                orderAssetsId: '',
                form: {
                    title: '',
                    whoisfor: '',
                    takeaway: '',
                    react: '',
                    misc: ''
                },
                formError: false,
                formValidation: {
                    title: false,
                    whoisfor: false,
                    takeaway: false,
                    react: false,
                    misc: false
                },
                step: 0,
                errors: []
            }
        },
        computed: {
            progressWidth: function () {
                return "width:" + this.progress + "%";
            }
        },
        methods: {
            upload(e) {
                //this.barSuccess();
                let token = document.querySelector('#token').getAttribute('value');
                e.preventDefault();
                this.disabled(); //// disabled button
                this.hideProgress = false;
                this.errorUploadFile = false;
                this.progress = 0;
                let files = $('#video')[0].files[0];
                let data = new FormData();
                data.append('video', files);
                data.append('_token', token);
                let self = this;
                $.ajax({
                    url: '/portal/my-videos/upload',
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
                        self.loader = false;
                        self.hideProgress = true;
                        self.orderAssetsId = data;
                        self.step = 1;
                        self.undisabled();
                    },
                    error: function (error) {
                        self.loader = false;
                        self.hideProgress = true;
                        self.errorUploadFile = true;
                        self.errors = JSON.parse(error.responseText).video;
                        self.undisabled();
                    }
                });
            },
            disabled() {
                $('#buttonUpload').attr("disabled", "disabled");
                $('#video').attr("disabled", "disabled");
            },
            undisabled() {
                $('#buttonUpload').removeAttr("disabled");
                $('#video').removeAttr("disabled");
            },
            submitForm() {
                this.formError = false;
                for (let key in this.form) {
                    if(this.form[key] == "") {
                        this.formValidation[key] = true;
                        this.formError = true;
                    }
                }
                if(this.formError == false) {
                    let form = $('#userForm1');
                    let csrfToken = document.querySelector('#token').getAttribute('value');
                    form.append($('<input type="hidden" name="_token">').val(csrfToken));
                    // and submit
                    form.submit();
                }
            }
        }
    }

</script>
