import SubscriptionAPI from '../api/v1/subscription'

export default {
    namespaced: true,
    state: {
        subscriptions: []
    },
    getters: {
        hasSubscriptions (state) {
            return state.subscriptions.length > 0
        },
        subscriptions (state) {
            return state.subscriptions
        },
    },
    mutations: {
        ['GET_SUBSCRIPTIONS_SUCCESS'](state, subscriptions) {
            state.subscriptions = subscriptions
        }
    },
    actions: {
        getSubscriptions ({commit}) {
            return SubscriptionAPI.getSubscriptions()
                .then(res => commit('GET_SUBSCRIPTIONS_SUCCESS', res.data))
        },
        getPartnerSubscriptions ({commit}, idPartner) {
            return SubscriptionAPI.getPartnerSubscriptions(idPartner)
                .then(res => commit('GET_SUBSCRIPTIONS_SUCCESS', res.data))
        }
    }
}