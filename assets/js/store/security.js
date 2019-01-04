import SecurityAPI from '../api/security'

export default {
    namespaced: true,
    state: {
        isAuthenticated: false,
        username: null,
        roles: [],
        error: null
    },
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated
        },
        username (state) {
            return state.username
        },
        hasRole (state) {
            return role => {
                return state.roles.indexOf(role) !== -1
            }
        },
        hasError (state) {
            return state.error !== null
        },
        error (state) {
            return state.error
        },
    },
    mutations: {
        ['AUTHENTICATING'](state) {
            state.isAuthenticated = false
            state.username = null
            state.roles = []
            state.error = null
        },
        ['AUTHENTICATING_SUCCESS'](state, data) {
            state.isAuthenticated = true
            state.username = data.username
            state.roles = data.roles
            state.error = null
        },
        ['AUTHENTICATING_ERROR'](state, error) {
            state.isAuthenticated = false
            state.username = null
            state.roles = []
            state.error = error
        },
        ['PROVIDING_DATA_ON_REFRESH_SUCCESS'](state, payload) {
            state.isAuthenticated = payload.isAuthenticated
            state.username = payload.username
            state.roles = payload.roles
            state.error = null
        },
    },
    actions: {
        login ({commit}, payload) {
            commit('AUTHENTICATING')
            return SecurityAPI.login(payload.username, payload.password)
                .then(res => commit('AUTHENTICATING_SUCCESS', res.data))
                .catch(err => commit('AUTHENTICATING_ERROR', err))
        },
        onRefresh({commit}, payload) {
            commit('PROVIDING_DATA_ON_REFRESH_SUCCESS', payload)
        },
        logout ({commit}) {
            commit('AUTHENTICATING')
            return SecurityAPI.logout()
        }
    }
}