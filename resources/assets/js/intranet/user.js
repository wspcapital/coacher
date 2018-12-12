import workShop from './../components/intranet/workshopVideos.vue';
import learning from './../components/intranet/learningVideos.vue';
import webinar from './../components/intranet/webinarVideos.vue';
import blockUser from './../components/intranet/block-user.vue';
import moment from 'moment';
require('./../responsive-table');

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YY')
    }
});

new Vue({
    el: "#one-user",
    data: {
        url: window.location.pathname,
        roles: {},
        user: {},
        blockStatus: 'sss'
    },
    components: {
        'workshop-videos': workShop,
        'learning-videos': learning,
        'webinar-videos': webinar,
        'block-user': blockUser
    },
    methods: {
        submit() {
            $('#userForm').submit()
        },
        sendAccount(userId) {
            this.$http.get(`/intranet/user-event/send-account/${userId}`).then((response) => {
                this.successFunc('#send-account');
            }, (response) => {
                this.errorFunc('#send-account');
            });
        },
        sendEmail(userId) {
            this.$http.get(`/intranet/user-event/send-email/${userId}`).then((response) => {
                this.successFunc('#send-email');
            }, (response) => {
                this.errorFunc('#send-email');
            });
        },
        successFunc(el) {
            $(el).addClass('btn-success');
            let self = this;
            setTimeout(function () {
                self.deleteClass(el, 'btn-success');
            }, 2000)
        },
        errorFunc(el) {
            $(el).addClass('btn-danger');
            let self = this;
            setTimeout(function () {
                self.deleteClass(el, 'btn-danger');
            }, 2000)
        },
        deleteClass(selector, className) {
            $(selector).removeClass(className);
        },
        confirmDelete(e) {
            if (confirm("Are you shure?")) {
                return true;
            } else {
                e.preventDefault();
            }
        }
    }
});
