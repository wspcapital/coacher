require('./../../../../node_modules/jquery-ui');
let path = location.pathname.slice(1);
let moduleName = path.split('/');

if (moduleName[2] !== 'new') {
    require('./bulk/participant');
}
    new Vue({
        el: '#app-bulk',
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


