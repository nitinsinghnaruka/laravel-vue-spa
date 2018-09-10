import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';

const Helpers = {};

Helpers.install = function (Vue, options) {
  
  Vue.use(VueIziToast);

  /**
   * Show message|toast.
   * 
   * @param {string}      type
   * @param {string}      message
   * @param {string|null} title
   */
  Vue.prototype.$showMessage = function (type, message, title = '', options = {}) {
    let defaultOptions = {
      theme: 'custom',
      position: 'bottomCenter',
      progressBar: false,
      close: false,
      timeout: 3000,
    };

    // Merge options with default options.
    options = Object.assign(defaultOptions, options);

    this.$toast[type](message, title, options);
  }

  /**
   * Check given value is empty or not.
   * 
   * @param   {*|null}  value
   * @returns {boolean}
   */
  Vue.prototype.$isEmpty = function (value = null) {
    if (value) {
      if (typeof value == 'object') {
        return Object.keys(value).length == 0;
      } else if (Array.isArray(isArray)) {
        return value.length == 0;
      }
    }

    return true;
  }
}

export default Helpers;
