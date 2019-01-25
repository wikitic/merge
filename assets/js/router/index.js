import Vue from 'vue'
import Router from 'vue-router'

import Login from '../views/Login'
import Logout from '../views/Logout'

import Modules from '../views/Modules.vue'

Vue.use(Router);


export default new Router({
    mode: 'history',
    routes: [
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