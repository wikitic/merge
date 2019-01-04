import PartnerAPI from '../api/partner'

export default {
    namespaced: true,
    state: {
        error: null,
        partners: []
    },
    getters: {
        hasError (state) {
            return state.error !== null
        },
        error (state) {
            return state.error
        },
        hasPartners (state) {
            return state.partners.length > 0
        },
        partners (state) {
            return state.partners
        },
    },
    mutations: {
        ['INITIALIZING'](state) {
            state.error = null
        },

        // GET
        ['GET_PARTNERS_SUCCESS'](state, partners) {
            state.error = null
            state.partners = partners
        },
        ['GET_PARTNERS_ERROR'](state, error) {
            state.error = error
        },

        // POST
        ['POST_PARTNERS_SUCCESS'](state, partner) {
            state.error = null
            state.partners.push(partner)
        },
        ['POST_PARTNERS_ERROR'](state, error) {
            state.error = error
        },

        // PATCH
        ['PATCH_PARTNERS_SUCCESS'](state, partner) {
            state.error = null
            state.partners.splice(state.partners.indexOf(partner), 1)
            state.partners.push(partner)
        },
        ['PATCH_PARTNERS_ERROR'](state, error) {
            state.error = error
        },

        // DELETE
        ['DELETE_PARTNERS_SUCCESS'](state, partner) {
            state.error = null
            state.partners.splice(state.partners.indexOf(partner), 1)
        },
        ['DELETE_PARTNERS_ERROR'](state, error) {
            state.error = error
        },
    },
    actions: {
        getPartners ({commit}) {
            commit('INITIALIZING')
            return PartnerAPI.getPartners()
                .then(res => commit('GET_PARTNERS_SUCCESS', res.data))
                .catch(err => commit('GET_PARTNERS_ERROR', err))
        },
        postPartners ({commit}, partner) {
            commit('INITIALIZING')
            return PartnerAPI.postPartners(partner)
                .then(res => commit('POST_PARTNERS_SUCCESS', res.data))
                //.catch(error => commit('POST_PARTNERS_ERROR', error))
        },
        patchPartners ({commit}, partner) {
            commit('INITIALIZING')
            return PartnerAPI.patchPartners(partner)
                .then(res => commit('PATCH_PARTNERS_SUCCESS', res.data))
                //.catch(err => commit('PATCH_PARTNERS_ERROR', err))
        },
        deletePartners ({commit}, partner) {
            commit('INITIALIZING')
            return PartnerAPI.deletePartners(partner)
                .then(() => commit('DELETE_PARTNERS_SUCCESS', partner))
                .catch(error => commit('DELETE_PARTNERS_ERROR', error))
        }        
    }
}