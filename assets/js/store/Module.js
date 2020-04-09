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
        ['INIT'](state, module) {
            state.module = []
        },
        ['GET_MODULE_SUCCESS'](state, module) {
            state.module = module
        }
    },
    actions: {
        getModule ({commit}, payload) {
            commit('INIT', null)
            return new Promise( (resolve, reject) => {
                ModuleAPI.getModuleByAlias(payload)
                    .then(res => {
                        //setTimeout(() => {
                            commit('GET_MODULE_SUCCESS', res.data)
                            resolve(res.data)
                        //},1000)
                    }).catch( err => {
                    reject(err)
                })
            })
        }
    }
}
