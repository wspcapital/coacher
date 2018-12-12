import participants from '../components/docs/participants.vue';
import bookingdays from '../components/docs/bookingdays.vue';

new Vue({
    el: '#logisticsForm',
    data: {
        errors: {
            status: false,
            message: ''
        },
        countryLocation: '',
        participants: {}
    },
    created() {
        this.setCountryLocation()
    },
    components : {
        'participants': participants,
        'bookingdays': bookingdays
    },
    methods: {
        clearError() {
            this.errors.status = false;
            this.errors.message = '';
        },
        getToken() {
            return document.querySelector('#token').getAttribute('value');
        },
        getId() {
            let url = window.location.pathname;
            let id = url.split('/');
            return id[3];
        },
        setCountryLocation() {
            this.countryLocation = $("[name=location_country]").val();
        }
    }
});