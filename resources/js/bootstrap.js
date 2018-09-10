
window._      = require('lodash');
window.Popper = require('popper.js').default;
window.$      = window.jQuery = require('jquery');

require('bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Helpers from './plugins/helpers';
import store from './store';
import axios from './http';
import Form from './utilities/form';
import Auth from './auth';

window.Vue   = Vue;
window.Event = new Vue();
window.store = store;
window.axios = axios;
window.Form  = Form;
window.Auth  = new Auth();

window.Vue.use(VueRouter);
window.Vue.use(Helpers);

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true,
  auth: {
    headers: {
      Authorization: 'Bearer ' + store.state.auth.token
    }
  }
});
