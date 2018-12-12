import VueI18n from 'vue-i18n';

// ready translated locales
var locales = {
    en: {
        message: {
            hello: 'hello world'
        }
    },
    ja: {
        message: {
            hello: 'こんにちは、世界'
        }
    }
};

// set lang
Vue.config.lang = 'ja';

// set locales
Object.keys(locales).forEach(function (lang) {
    Vue.locale(lang, locales[lang])
});

// create instance
new Vue({
    el: '#app',

});