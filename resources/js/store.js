import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let store = new Vuex.Store({
  state: {
    auth: {
      isUserLoggedIn: !!localStorage.getItem('token'),
      token: localStorage.getItem('token'),
      user: JSON.parse(localStorage.getItem('user'))
    }
  },
  mutations: {
    loginUser (state) {
      // Set auth data.
      state.auth = {
        isUserLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token'),
        user: JSON.parse(localStorage.getItem('user'))
      };
    },
    logoutUser (state) {
      // Remove auth data.
      state.auth = {
        isUserLoggedIn: false,
        token: null,
        user: null
      }
    }
  }
});

export default store;
