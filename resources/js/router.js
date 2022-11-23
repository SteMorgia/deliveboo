import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from './pages/HomePage.vue';
import SingleRestaurantPage from './pages/SingleRestaurantPage.vue';
import Redirect from './pages/Redirect.vue';
import NotFound from './pages/NotFound.vue';

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
        },
        {
            path: '/*', // raccolgo tutti gli uri che non sono presenti in questo array.
            name: 'not-found',
            component: NotFound
        }
    ]
});

export default router;