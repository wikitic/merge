import ModulesAPI from '../api/v1/ModuleController'

export default {
    namespaced: true,
    state: {
        modules: []
    },
    getters: {
        modules (state) {
            return state.modules
        },
    },
    mutations: {
        ['GET_MODULES_SUCCESS'](state, modules) {
            state.modules = modules
        }
    },
    actions: {
        getModules ({commit}, language) {
            return ModulesAPI.getModules(language)
                .then(res => commit('GET_MODULES_SUCCESS', res.data))
        }
    }
}