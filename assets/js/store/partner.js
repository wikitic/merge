import PartnerAPI from '../api/partner';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        partners: [],
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
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
        ['CREATING_PARTNER'](state) {
            state.isLoading = true;
            state.error = null;
        },
        ['CREATING_PARTNER_SUCCESS'](state, partner) {
            state.isLoading = false;
            state.error = null;
            state.partners.unshift(partner);
        },
        ['CREATING_PARTNER_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.partners = [];
        },
        ['FETCHING_PARTNERS'](state) {
            state.isLoading = true;
            state.error = null;
            state.partners = [];
        },
        ['FETCHING_PARTNERS_SUCCESS'](state, partners) {
            state.isLoading = false;
            state.error = null;
            state.partners = partners;
        },
        ['FETCHING_PARTNERS_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.partners = [];
        },
    },
    actions: {
        getPartners ({commit}) {
            commit('FETCHING_PARTNERS');
            return PartnerAPI.getPartners()
                .then(res => commit('FETCHING_PARTNERS_SUCCESS', res.data))
                .catch(err => commit('FETCHING_PARTNERS_ERROR', err));
        },        
        patchPartners ({commit}, partner) {
            //commit('CREATING_PARTNER');
            return PartnerAPI.patchPartners(partner)
                //.then(res => commit('CREATING_PARTNER_SUCCESS', res.data))
                .catch(err => commit('CREATING_PARTNER_ERROR', err));
        }
        
    }
}