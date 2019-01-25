import Vue from 'vue'
import Vuex from 'vuex'

import Security from './Security'
import ModulesStore from './ModulesStore'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Security: Security,
        ModulesStore: ModulesStore
    }
})
