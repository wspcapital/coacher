'use strict';

new Vue({
    el: '#app-new-booking',
    data: {
        countryLocation: ''
    },
    created() {
        this.setCountryLocation()
    },

    methods: {
        setCountryLocation() {
            this.countryLocation = $("[name=location_country]").val();
        }
    }
});
