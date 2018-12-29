import Vue from 'vue';
import Vuex from 'vuex';
import SecurityModule from './security';
import PartnerModule from './partner';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        security: SecurityModule,
        partner: PartnerModule,
    }
});