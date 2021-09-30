/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from "./routes";

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
})

Vue.component('employees-index', require('./components/employees/index').default);


const app = new Vue({
    el: '#app',
    router
});

