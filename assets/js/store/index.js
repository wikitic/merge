import Vue from 'vue'
import Vuex from 'vuex'

import Security from './Security'
import Modules from './Modules'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Security: Security,
        Modules: Modules
    }
})
