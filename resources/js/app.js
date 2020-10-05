window.Vue = require('vue')
window.axios = require('axios');
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './layouts/App'
import {routes} from  './routes'


Vue.prototype.$api_url = "http://localhost:8500"
Vue.use(VueRouter)


const router = new VueRouter({
    mode: 'history',
    routes,
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
