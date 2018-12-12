<div class="row" id="attachment">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-attachments">
        Attachments</h2>
    <div id="sec-attachments" class="collapse booking-block">
        <div class="files-block">
            <ul class="list-group">
                <li class="list-group-item" v-for="file in allFiles">
                    <a :href="path + file.assets.id + '/' + file.assets.media[0].file_name"
                       target="_blank">@{{ file.assets.media[0].file_name }}</a>
                    <a href="" @click.prevent="deleteFile(file.assets.id)" class="pull-right">
                        <i class="fa fa-trash"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="progress" v-if="!hideProgress">
            <div class="progress-bar progress-bar-warning" role="progressbar"
                 aria-valuemin="0"
                 aria-valuemax="100" :style="progressWidth">
            </div>
        </div>
        <div class="alert alert-danger" v-if="errorUploadFile">
            <div v-for="error in errors">
                <strong>Error!</strong> @{{ error }}
            </div>
        </div>
        <div class="clearfix">
            <div class="button-block">
                <input type="file" @change="upload" name="file" id="booking-file" class="inputfile"/>
                <label class="btn btn-primary variable"  id="buttonUpload" for="booking-file">Browse</label>
                <button v-show="allFiles.length > 0" class="btn btn-danger pull-right" @click.prevent="deleteAllFile()">
                    Remove All
                </button>
            </div>
        </div>
    </div>
</div>