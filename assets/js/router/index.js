import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Login from '../views/Login';
import Logout from '../views/Logout';
import Profile from '../views/Profile';
import Dashboard from '../views/Dashboard';
import Partners from '../views/Partners';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                guest: true
            },
        },
        {
            path: '/logout',
            name: 'Logout',
            component: Logout,
            meta: {
                requiresAuth: true
            },
        },
        { 
            path: '/profile',
            name: 'Profile',
            component: Profile, 
            meta: { 
                requiresAuth: true 
            } 
        },
        { 
            path: '/dashboard',
            name: 'Dashboard',
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