import LanguageAPI from '../api/v1/LanguageController'

export default {
    namespaced: true,
    state: {
        language: []
    },
    getters: {
        language (state) {
            return state.language
        }
    },
    mutations: {
        ['INIT'](state, language) {
            state.language = []
        },
        ['GET_LANGUAGE_SUCCESS'](state, language) {
            state.language = language
        }
    },
    actions: {
        getLanguage ({commit}, payload) {
            commit('INIT', null)
            return new Promise( (resolve, reject) => {
                LanguageAPI.getLanguageByAlias(payload)
                    .then(res => {
                        //setTimeout(() => {
                            commit('GET_LANGUAGE_SUCCESS', res.data)
                            resolve(res.data)
                        //},1000)
                    }).catch( err => {
                    reject(err)
                })
            })
        }
    }
}
