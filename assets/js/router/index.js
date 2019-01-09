import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import Login from '../views/Login'
import Logout from '../views/Logout'
import Profile from '../views/Profile'
import Home from '../views/Home'

import Partners from '../views/Partners/Index'
import PartnersList from '../views/Partners/List'
import PartnersView from '../views/Partners/View'

import SubscriptionsList from '../views/Subscriptions/List'

Vue.use(VueRouter)

let router = new VueRouter({
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
            path: '/',
            name: 'Página principal',
            component: Home, 
            meta: { 
                requiresAuth: true,
                breadcrumb: [
                ]
            } 
        },
        { 
            path: '/profile',
            name: 'Perfil',
            component: Profile, 
            meta: { 
                requiresAuth: true,
                breadcrumb: [
                    { name: 'Página principal', href: 'Página principal' },
                ]
            } 
        },
        { 
            path: '/partners',
            component: Partners,
            meta: {
                requiresAuth: true,
            },
            children: [
                { 
                    path: '',
                    component: PartnersList,
                    name: 'Socios',
                    meta: {
                        requiresAuth: true,
                        breadcrumb: [
                            { name: 'Página principal', href: 'Página principal' },
                        ]
                    }
                },
                { 
                    path: ':idPartner',
                    component: PartnersView,
                    name: 'Socio',
                    meta: {
                        requiresAuth: true,
                        breadcrumb: [
                            { name: 'Página principal', href: 'Página principal' },
                            { name: 'Socios', href: 'Socios' },
                        ]
                    }
                }
            ]
        },
        { 
            path: '*',
            redirect: '/'
        }
    ],
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (store.getters['security/isAuthenticated']) {
            next()
        } else {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        }
    } else {
        next() // make sure to always call next()!
    }
})

export default router