import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Login from '../views/Login';
import Dashboard from '../views/Dashboard';
import Partners from '../views/Partners';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            component: Login,
            meta: {
                guest: true
            },
        },
        { 
            path: '/dashboard',
            component: Dashboard, 
            meta: { 
                requiresAuth: true 
            } 
        },
        { 
            path: '/partners',
            component: Partners,
            meta: {
                requiresAuth: true
            }
        },
        { 
            path: '*',
            redirect: '/dashboard'
        }
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (store.getters['security/isAuthenticated']) {
            next();
        } else {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;