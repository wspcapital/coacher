import needCredit from './../components/portal/need-credit.vue';
import uploadVideo from './../components/portal/upload-video.vue';


let vm = new Vue({
    el: "#my-videos",
    data: {
        videoUpload: false,
        step: 0,
        orderAssetsId: '1'
    },
    components: {
        "need-credit": needCredit,
        "video-upload": uploadVideo
    },
    methods:{
        playVideo(path) {
            $('#video-block>video').attr('src', path).attr('width', '640px').attr('height', '400px').show();
        }
    }
});
