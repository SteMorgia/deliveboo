import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from './pages/HomePage.vue';
import SingleRestaurantPage from './pages/SingleRestaurantPage.vue';
import Redirect from './pages/Redirect.vue';

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: HomePage
        },
        {
            path: '/restaurant/:slug', // parametro dinamico {slug-ristorante}
            name: 'restaurant',
            component: SingleRestaurantPage
        },
        {
            path: '/redirect', 
            name: 'redirect',
            component: Redirect
        }

    ]
});

export default router;