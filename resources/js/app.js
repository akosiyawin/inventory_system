require('./bootstrap');
import vuetify from "./vue/vuetify"
import router from './vue/routes/middleware'

window.Vue = require('vue').default;

Vue.component('App', require('./vue/App.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify,
});
