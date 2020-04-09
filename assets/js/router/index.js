import Vue from 'vue'
import Router from 'vue-router'

import Home from '../views/Home'

import Login from '../views/Login'
import Logout from '../views/Logout'

import RouterView from '../components/Layouts/RouterView.vue'

import Courses from '../views/Courses/Courses.vue'
import Language from '../views/Courses/Language.vue'
import Module from '../views/Courses/Module.vue'
import Lesson from '../views/Courses/Lesson.vue'

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
            path: '/cursos-online',
            component: RouterView,
            children: [
                { 
                    path: '',
                    component: Courses,
                    name: 'Courses',
                    meta: {
                        guest: true
                    }
                },
                { 
                    path: ':language',
                    component: RouterView,
                    children: [
                        { 
                            path: '',
                            component: Language,
                            name: 'Language',
                            meta: {
                                guest: true
                            }
                        },
                        { 
                            path: ':module',
                            component: RouterView,
                            children: [
                                { 
                                    path: '',
                                    component: Module,
                                    name: 'Module',
                                    meta: {
                                        guest: true
                                    }
                                },
                                { 
                                    path: ':lesson',
                                    component: Lesson,
                                    name: 'Lesson',
                                    meta: {
                                        guest: true
                                    }
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        { 
            path: '*',
            redirect: '/'
        }
    ]
})