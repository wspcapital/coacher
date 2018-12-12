<template>
    <div>
        <input type="hidden" name="asset_id" v-model="assetsId">
        <input type="file" @change="upload" name="video" id="upload-file" class="inputfile"/>
        <label class="btn btn-primary variable" for="upload-file">Browse</label>
        <div class="progress" v-show="progress != 0">
            <div class="progress-bar" role="progressbar"
                 aria-valuemin="0"
                 aria-valuemax="100" :style="progressWidth">
            </div>
        </div>
        <div class="alert alert-success" v-if="progress == 100">
            <strong>Success!</strong> File {{fileName}} uploaded.
        </div>
        <div class="alert alert-danger" v-if="errorStatus">
            <strong>Danger!</strong> {{ errorMessage }}
        </div>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                progress: 0,
                assetsId: '',
                fileName: '',
                errorStatus: false,
                errorMessage: ''
            }
        },
        props: ['oldAssetId'],

         computed: {
            progressWidth: function () {
                return "width:" + this.progress + "%";
            }
        },
        methods: {
           upload() {
                this.saveStatus = true;
                this.progress = 50;
                let token = this.getToken();
                let files = $('#upload-file')[0].files[0];
                let data = new FormData();
                data.append('file', files);
                data.append('_token', token);
                data.append('asset_id', this.oldAssetId);
                this.$http.post('/intranet/lib/upload-file', data).then (
                function (data, status, request) {
                console.log(data.body);
                    this.assetsId = data.body.assets_id;
                    this.fileName = data.body.fileName;
                    this.progress = 100;
                    this.saveStatus = true;

            },  function (error) {
                   this.progress = 0;
                   this.errorStatus = true;
                   this.errorMessage = error.body;
            });
            },
              getToken() {
                return document.querySelector('#token').getAttribute('value');
            },
        }
    }

</script>
