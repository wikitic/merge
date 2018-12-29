import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home';
import Partners from '../views/Partners';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: Home },
        { path: '/partners', component: Partners },
        { path: '*', redirect: '/home' }
    ],
});