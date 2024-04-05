require('./bootstrap');


import Vue from 'vue'
import Vuetify from 'vuetify'
import Router from './router'
import App from './template/App';
import store from './store'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(Vuetify)

Vue.component('login-app', require('./base/Login').default);

const app = new Vue({
    el:'#app',
    store,
    router:Router,
    vuetify: new Vuetify(),
    render: h => h(App)
});