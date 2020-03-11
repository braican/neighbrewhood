import Vue from 'vue';
import Router from 'vue-router';

import Home from './views/Home';

Vue.use(Router);

const router = new Router({
  mode: 'history',
  scrollBehavior: () => ({ x: 0, y: 0 }),
  routes: [
    {
      path: '*',
      redirect: '/',
    },
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/admin',
      name: 'Admin',
      component: () => import(/* webpackChunkName: "admin" */ './views/Admin.vue'),
      meta: {
        requiresAdmin: true,
      },
    },
  ],
});

export default router;
