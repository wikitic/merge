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
        getLanguage ({commit}, language) {
            return LanguageAPI.getLanguagesByAlias(language)
                .then(res => commit('GET_LANGUAGE_SUCCESS', res.data))
        }
    }
}
