window.Vue = require('vue');
import VueProgressBar from 'vue-progressbar';

window.axios = require('axios');
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './layouts/App'
import {routes} from  './routes'

 


Vue.prototype.$api_url = "http://localhost:8500";

Vue.use(VueRouter)
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }
  
  Vue.use(VueProgressBar, options)

const router = new VueRouter({
    mode: 'history',
    routes,
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
