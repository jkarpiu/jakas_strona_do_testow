/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

import Login from './components/Login'
import Pytanka from './components/PytankaCopy'
import Welcome from './components/Welcome'
import App from './components/App'
import Register from './components/Register';
import Wyniki from './components/ZapisaneWyniki';
import * as VueSpinnersCss from "vue-spinners-css";
import VueCookies from 'vue-cookies'

Vue.use(VueCookies)
Vue.use(VueRouter)
Vue.use(VueSpinnersCss);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: Welcome
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/losowanie40',
        name: 'losowanie40',
        component: Pytanka,
        props: {ilosc: 40}
    },
    {
        path: '/losowanie1',
        name: 'losowanie1',
        component: Pytanka,
        props: {ilosc: 1}
    },
    {
        path: "/user/wyniki",
        name: "wynikiUcznia",
        component: Wyniki

    }

];

const router = new VueRouter({
    mode: 'history',
    routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
