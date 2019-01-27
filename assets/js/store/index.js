import Vue from 'vue'
import Vuex from 'vuex'

import Security from './Security'

import Language from './Language'
import Module from './Module'
import Lesson from './Lesson'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Security: Security,
        Language: Language,
        Module: Module,
        Lesson: Lesson
    }
})
