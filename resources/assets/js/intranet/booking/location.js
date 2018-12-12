'use strict';

new Vue({
    el: '#location',
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
