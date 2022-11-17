window.Vue = require('vue');
window.axios = require('axios');
//require('./bootstrap');

import Vue from 'vue';
import vueBraintree from './braintree.js';
import App from './views/App';

import router from './router.js';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});