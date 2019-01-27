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
        ['GET_LANGUAGE_SUCCESS'](state, language) {
            state.language = language
        }
    },
    actions: {
        getLanguage ({commit}, payload) {
            return LanguageAPI.getLanguageByAlias(payload)
                .then(res => commit('GET_LANGUAGE_SUCCESS', res.data))
        }
    }
}
