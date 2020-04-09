import SecurityAPI from '../api/v1/Security'

export default {
    namespaced: true,
    state: {
        isAuthenticated: false,
        user: null
    },
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated
        },
        user (state) {
            return state.user
        }
    },
    mutations: {
        ['LOGIN_SUCCESS'](state, user) {
            state.isAuthenticated = true
            state.user = user
        },
        /*
        ['LOGOUT_SUCCESS'](state) {
            state.isAuthenticated = false
            state.user = null
        },
        ['REFRESH_SUCCESS'](state, payload) {
            state.isAuthenticated = payload.isAuthenticated
            state.user = payload.user
        }*/
    },
    actions: {
        login ({commit}, partner) {
            return SecurityAPI.login(partner)
                .then(res => commit('LOGIN_SUCCESS', res.data))
        },/*   
        logout ({commit}) {
            commit('LOGOUT_SUCCESS')
            return SecurityAPI.logout()
        },    
        onRefresh({commit}, payload) {
            commit('REFRESH_SUCCESS', payload)
        }*/
    }
}