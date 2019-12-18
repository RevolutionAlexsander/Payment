/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import AddAplication from "./components/AddAplication";
import VueRouter from 'vue-router'
import Application from "./components/Application";
import Account from "./components/Account";
import Payment from "./components/Payment";
import PaymentAdd from "./components/PaymentAdd";

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('application', require('./components/Application').default);
Vue.component('addapplication', require('./components/AddAplication').default);
Vue.component('account', require('./components/Account').default);
Vue.component('payment', require('./components/Payment').default);
Vue.component('paymentAdd', require('./components/PaymentAdd').default);
Vue.component('paymentAuto', require('./components/AutoPayment').default);
Vue.component('paymentAutoAdd', require('./components/AddAutoPayment').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    { path: '/application/add', component: AddAplication, name: 'AddAplication' },
    { path: '/application', component: Application },
    { path: '/account', component: Account },
    { path: '/payment', component: Payment },
    { path: '/payment/add', component: PaymentAdd },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
new Vue({
    el: '#app',
    router: router
});
