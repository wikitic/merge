import ModuleAPI from '../api/v1/ModuleController'

export default {
    namespaced: true,
    state: {
        module: []
    },
    getters: {
        module (state) {
            return state.module
        }
    },
    mutations: {
        ['GET_MODULE_SUCCESS'](state, module) {
            state.module = module
        }
    },
    actions: {
        getModule ({commit}, module) {
            return ModuleAPI.getModulesById(module)
                .then(res => commit('GET_MODULE_SUCCESS', res.data))
        }
    }
}
