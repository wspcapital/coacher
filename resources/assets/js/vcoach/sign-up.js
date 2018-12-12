new Vue({
    el: '#app',
    data: {
        step: 1,
        user: {
            first_name: '',
            last_name: '',
            phone: '',
            email: '',
            email_confirmation: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        nextForm() {
            this.step = this.step + 1;
        },

        previous() {
            this.step = this.step - 1;
        },

        registration() {
            let form = $('#myForm');
            form.get(0).submit();
        }
    }
});