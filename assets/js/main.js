import Vue from 'vue';
import Vuetify from 'vuetify'
import App from './App';
import router from './router';
import store from './store';

Vue.use(Vuetify)
import 'vuetify/dist/vuetify.min.css' 

Vue.config.productionTip = false

require('../scss/app.scss');

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
})