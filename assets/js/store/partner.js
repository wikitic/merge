import PartnerAPI from '../api/v1/partner'
import SubscriptionAPI from '../api/v1/subscription'

export default {
    namespaced: true,
    state: {
        partners: []
    },
    getters: {
        hasPartners (state) {
            return state.partners.length > 0
        },
        partners (state) {
            return state.partners
        },
    },
    mutations: {
        ['GET_PARTNERS_SUCCESS'](state, partners) {
            state.partners = partners
        },
        ['POST_PARTNERS_SUCCESS'](state, partner) {
            state.partners.push(partner)
        },
        ['PATCH_PARTNERS_SUCCESS'](state, partner) {
            state.partners.splice(state.partners.indexOf(partner), 1)
            state.partners.push(partner)
        },
        ['DELETE_PARTNERS_SUCCESS'](state, partner) {
            state.partners.splice(state.partners.indexOf(partner), 1)
        },

        ['POST_SUBSCRIPTIONS_SUCCESS'](state, partner) {
            //state.partners.splice(state.partners.indexOf(partner), 1)
            //state.partners.push(partner)
        },
        ['DELETE_SUBSCRIPTIONS_SUCCESS'](state, subscription) {
            let partner = state.partners[state.partners.indexOf(subscription.partner)]
            partner.subscriptions.splice(partner.subscriptions.indexOf(subscription), 1)
            partner.numSubscriptions-=1
        },
    },
    actions: {
        getPartners ({commit}) {
            return PartnerAPI.getPartners()
                .then(res => commit('GET_PARTNERS_SUCCESS', res.data))
        },
        postPartners ({commit}, partner) {
            return PartnerAPI.postPartners(partner)
                .then(res => commit('POST_PARTNERS_SUCCESS', res.data))
        },
        patchPartners ({commit}, partner) {
            return PartnerAPI.patchPartners(partner)
                .then(res => commit('PATCH_PARTNERS_SUCCESS', res.data))
        },
        deletePartners ({commit}, partner) {
            return PartnerAPI.deletePartners(partner)
                .then(() => commit('DELETE_PARTNERS_SUCCESS', partner))
        },
        
        postSubscriptions ({commit}, subscription) {
            return SubscriptionAPI.postSubscriptions(subscription)
                .then(res => commit('POST_SUBSCRIPTIONS_SUCCESS', res.data))
        },
        deleteSubscriptions ({commit}, subscription) {
            return SubscriptionAPI.deleteSubscriptions(subscription)
                .then(() => commit('DELETE_SUBSCRIPTIONS_SUCCESS', subscription))
        },
    }
}