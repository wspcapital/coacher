import NeedCredit from './../components/portal/need-credit.vue'

new Vue({
    el: "#vcoach",
    data: {
        step: 0,
        inSession: false,
    },
    components: {
        'need-credit': NeedCredit
    }
});

$(function () {
    $('#sessionForm').on('submit', function (e) {
        e.preventDefault();
        if ($('#term').prop("checked")) {
            this.submit();
        } else {
            $('#error-term').show();
        }
    })
});
