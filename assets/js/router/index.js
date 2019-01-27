import Vue from 'vue'
import Router from 'vue-router'

import Home from '../views/Home'

import Login from '../views/Login'
import Logout from '../views/Logout'

import CoursesIndex from '../views/Courses/Index.vue'
import Courses from '../views/Courses/Courses.vue'

import ModulesIndex from '../views/Modules/Index.vue'
import Modules from '../views/Modules/Modules.vue'

import LessonsIndex from '../views/Lessons/Index.vue'
import Lessons from '../views/Lessons/Lessons.vue'
import Lesson from '../views/Lessons/Lesson.vue'

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
            component: CoursesIndex,
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
                    component: ModulesIndex,
                    children: [
                        { 
                            path: '',
                            component: Modules,
                            name: 'Modules',
                            meta: {
                                guest: true
                            }
                        },
                        { 
                            path: ':module',
                            component: LessonsIndex,
                            children: [
                                { 
                                    path: '',
                                    component: Lessons,
                                    name: 'Lessons',
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