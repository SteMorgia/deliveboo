window.Vue = require('vue');
window.axios = require('axios');
//require('./bootstrap');

import Vue from 'vue';
import App from './views/App';

// importo e uso braintree;
import vueBraintree from 'vue-braintree';
Vue.use(vueBraintree);

import router from './router.js';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
