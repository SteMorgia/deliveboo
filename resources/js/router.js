import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from './pages/HomePage.vue';
import SingleRestaurantPage from './pages/SingleRestaurantPage.vue';


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: HomePage
        },
        {
            path: '/restaurant', // parametro dinamico {slug-ristorante}
            name: 'prova',
            component: SingleRestaurantPage
        }
    ]
});

export default router;