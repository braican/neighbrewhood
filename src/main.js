import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './registerServiceWorker';

import './styles/globals.scss';

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  created() {
    store.dispatch('fetchBreweries');
  },
  render: h => h(App),
}).$mount('#app');

