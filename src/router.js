import Vue from 'vue';
import Router from 'vue-router';
import firebase from 'firebase/app';
import { adminEmail } from './config';

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

router.beforeEach((to, from, next) => {
  const requiresAdmin = to.matched.some(({ meta }) => meta.requiresAdmin);
  const { currentUser } = firebase.auth();

  if (requiresAdmin && (!currentUser || currentUser.email !== adminEmail)) {
    next('/');
  } else {
    next();
  }
});

export default router;
