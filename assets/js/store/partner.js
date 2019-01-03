import PartnerAPI from '../api/partner';

export default {
    namespaced: true,
    state: {
        error: null,
        partners: [],
    },
    getters: {
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        hasPartners (state) {
            return state.partners.length > 0;
        },
        partners (state) {
            return state.partners;
        },
    },
    mutations: {
        ['INITIALIZING'](state) {
            state.error = null;
        },

        ['CREATING_PARTNER'](state) {
            state.error = null;
        },
        ['CREATING_PARTNER_SUCCESS'](state, partner) {
            state.error = null;
            state.partners.unshift(partner);
        },
        ['CREATING_PARTNER_ERROR'](state, error) {
            state.error = error;
            state.partners = [];
        },
        ['FETCHING_PARTNERS'](state) {
            state.error = null;
            state.partners = [];
        },
        ['FETCHING_PARTNERS_SUCCESS'](state, partners) {
            state.error = null;
            state.partners = partners;
        },
        ['FETCHING_PARTNERS_ERROR'](state, error) {
            state.error = error;
            state.partners = [];
        },

        // DELETE
        ['DELETE_PARTNERS_SUCCESS'](state, partners) {
            state.error = null;
            state.partners.splice(state.partners.indexOf(partners), 1);
        },
        ['DELETE_PARTNERS_ERROR'](state, error) {
            state.error = error;
        },
    },
    actions: {
        getPartners ({commit}) {
            commit('FETCHING_PARTNERS');
            return PartnerAPI.getPartners()
                .then(res => commit('FETCHING_PARTNERS_SUCCESS', res.data))
                .catch(err => commit('FETCHING_PARTNERS_ERROR', err));
        },
        postPartners ({commit}, partner) {
            //commit('CREATING_PARTNER');
            return PartnerAPI.postPartners(partner)
                .then(res => res.data)
                .catch(err => err);
                //.then(res => commit('CREATING_PARTNER_SUCCESS', res.data))
                //.catch(err => commit('CREATING_PARTNER_ERROR', err));
        },
        patchPartners ({commit}, partner) {
            //commit('CREATING_PARTNER');
            return PartnerAPI.patchPartners(partner)
                //.then(res => commit('CREATING_PARTNER_SUCCESS', res.data))
                .catch(err => commit('CREATING_PARTNER_ERROR', err));
        },


        deletePartners ({commit}, partner) {
            commit('INITIALIZING');
            return PartnerAPI.deletePartners(partner)
                .then(() => commit('DELETE_PARTNERS_SUCCESS', partner))
                .catch(error => commit('DELETE_PARTNERS_ERROR', error));
        }        
    }
}