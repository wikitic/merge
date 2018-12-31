import Vue from 'vue';
import Vuetify from 'vuetify'
import App from './App';
import router from './router';
import store from './store';

import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify, {
    theme: {
      primary: '#E65100',
      //secondary: '#b0bec5',
      //accent: '#8c9eff',
      //error: '#b71c1c'
    }
  });

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