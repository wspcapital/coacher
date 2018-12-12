let vm = new Vue({
    el: "#video-tips",
    data: {},
    methods:{
        setVideo(path) {
            $('#video-block>video').attr('src', path).attr('width', '640px').attr('height', '400px').show();
        }
    }
});
