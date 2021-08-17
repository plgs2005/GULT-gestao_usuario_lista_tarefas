
require('./bootstrap');

import Vue from 'vue'

import Snotify from 'vue-snotify';
import router from './routes/routers'
import store from './vuex/store'

Vue.use(Snotify, {toast:{showProgressBar:false}})

require('./bootstrap'); 

window.Vue = Vue;

Vue.component('admin-component', require('./components/admin/AdminComponent').default);
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent').default)

const app = new Vue({
    router: router, 
    store: store,
    el: '#app',
});


store.dispatch('checkLogin')
    .then(() => router.push( { name: 'admin.dashboard' }))