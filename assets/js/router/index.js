import Vue from 'vue'
import Router from 'vue-router'

import Home from '../views/Home'

import Login from '../views/Login'
import Logout from '../views/Logout'

import Modules from '../views/Modules.vue'

Vue.use(Router);


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta: {
                guest: true
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                guest: true
            }
        },
        {
            path: '/logout',
            name: 'Logout',
            component: Logout,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/cursos-online/:language',
            name: 'Modules',
            component: Modules,
            meta: {
                guest: true
            }
        }
    ]
})