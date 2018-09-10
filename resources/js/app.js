require('./bootstrap');

import router from './routes';
import VueElementLoading from 'vue-element-loading';
import vueTopProgress from 'vue-top-progress';

Vue.use(vueTopProgress);

Vue.component('VueElementLoading', VueElementLoading);

new Vue({
  el: '#app',
  components: {
    App: require('./views/App')
  },
  router,
  store
});
