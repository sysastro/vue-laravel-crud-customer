/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import _ from 'lodash';
import App from './components/App.vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios);

import CustomerIndex from './components/CustomerIndex.vue';
import CustomerCreate from './components/CustomerCreate.vue';
import CustomerShow from './components/CustomerShow.vue';
import CustomerEdit from './components/CustomerEdit.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: CustomerIndex
    },
    {
        name: 'create',
        path: '/customer/create',
        component: CustomerCreate
    },
    {
        name: 'edit',
        path: '/customer/edit/:id',
        component: CustomerEdit
    },
    {
        name: 'show',
        path: '/customer/show/:id',
        component: CustomerShow
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
