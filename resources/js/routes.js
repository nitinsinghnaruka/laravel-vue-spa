import VueRouter from 'vue-router';

let titleSuffix = '';

let routes = [
  {
    path: '/',
    component: require('./views/Home'),
    meta: {
      title: 'Home',
      requiresAuth: true
    }
  },
  {
    path: '/chat',
    component: require('./views/Chat'),
    meta: {
      title: 'Chat',
      requiresAuth: true
    }
  },
  {
    path: '/login',
    component: require('./views/Login'),
    meta: {
      title: 'Login',
      requiresAuth: false
    }
  },
  {
    path: '/register',
    component: require('./views/Register'),
    meta: {
      title: 'Register',
      requiresAuth: false
    }
  },
  {
    path: '/*',
    component: require('./views/NotFound'),
    meta: {
      title: 'Not found',
      requiresAuth: false
    }
  }
];

let router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',
  routes
});

router.beforeEach((to, from, next) => {
  // Update page title.
  document.title = to.meta.title + titleSuffix;

  // Check if route requires auth then check user is logged in.
  if (to.meta.requiresAuth && ! store.state.auth.isUserLoggedIn) {
    // if user not logged in then redirect to login.
    next('/login');
  }

  // Check if route is login or register.
  // if user logged in then restrict user to view login and register.
  if ((to.path == '/login' || to.path == '/register') && store.state.auth.isUserLoggedIn) {
    next('/');
  }

  next();
});

export default router;
