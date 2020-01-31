
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import { Form, HasError, AlertError } from 'vform';
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


// Vue.component('course', require('./components/Course.vue'));

// let routes = [
//     { path: '/dashboard', component: require('./components/Course.vue') },
//   ]

const router = new VueRouter({
    mode: 'history',
    // short for `routes: routes`
  })

const app = new Vue({
    el: '#app',
    router,
});

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

