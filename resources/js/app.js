window.Vue = require('vue');
import VueProgressBar from 'vue-progressbar';

window.axios = require('axios');
import Vue from 'vue'
import VueRouter from 'vue-router'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

import App from './layouts/App'
import {routes} from  './routes'

Vue.config.productionTip = false;
Vue.config.devtools=false

// http://iagent.uz
Vue.prototype.$api_url = "http://iagent.uz";

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
  Vue.use(Chartkick.use(Chart))
const router = new VueRouter({
    mode: 'history',
    routes,
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,
});

