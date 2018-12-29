import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Home from '../views/Home';
import Login from '../views/Login';
import Partners from '../views/Partners';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: resolve => require(['../views/Login'], resolve),
            beforeEnter: (to, from, next) => {
              if (store.getters['security/isAuthenticated']) {
                next('/partners')
              } else {
                next()
              }
            },
            meta: {
              isPublic: true
            }
        },
        { path: '/dashboard', component: Partners, meta: { requiresAuth: true } },
        { path: '/partners', component: Partners, meta: { requiresAuth: true } },
        { path: '*', redirect: '/login' }
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