
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import * as VueGoogleMaps from 'vue2-google-maps';
import { Carousel } from 'bootstrap-vue/es/components';
import { Modal } from 'bootstrap-vue/es/components';

//import VueRouter from 'vue-router';
window.Vue.use(VueRouter);
window.Vue.use(VueGoogleMaps, {
    installComponents: true,
    load: {
        key: 'AIzaSyBayLe_XQAbUS883JqwQEhLRNwDM7XCFyU',
        libraries: 'places',
    },
});
window.Vue.use(Carousel);
window.Vue.use(Modal);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/mainindex/MainIndex.vue'));

const app = new Vue({
    el: '#app'
});
