import store from './store';

let axios = require('axios');

// Set axios default headers.
let token = document.head.querySelector('meta[name="csrf-token"]');

// Create an Instance
const instance = axios.create({
  baseURL: 'http://any.thing/api/',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': token ? token.content : null
  }
});

// Request interceptors.
instance.interceptors.request.use(function (config) {
  // Set authorization token.
  const token = store.state.auth.token;

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  } 

  return config;
}, function (error) {
  return Promise.reject(error);
});

// Response interceptors.
instance.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  // Handle user unauthenticated error.
  if (error && error.response.status == 401) {
    // Emit unauthorized event.
    Event.$emit('unauthorized');
  }

  return Promise.reject(error);
});

export default instance;
