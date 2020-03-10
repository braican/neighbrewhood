import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './registerServiceWorker';
import { auth } from './firebase';

import './styles/globals.scss';

Vue.config.productionTip = false;

let app;
auth.onAuthStateChanged(() => {
  if (!app) {
    app = new Vue({
      router,
      store,
      created() {
      },
      render: h => h(App),
    }).$mount('#app');
  }
});

