import Vue from 'vue';
import Vuex from 'vuex';
import PartnerModule from './partner';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        partner: PartnerModule,
    }
});