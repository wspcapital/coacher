new Vue({
    el: '#left-block',
    data: {
        show: false
    },
    methods: {
        showHide() {
            if (this.show) {
                $('#profile').slideUp();
                this.show = !this.show;
            }
            else {
                $('#profile').slideDown();
                this.show = !this.show;
            }
        }
    }
});
