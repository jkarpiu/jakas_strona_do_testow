/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import * as VueSpinnersCss from "vue-spinners-css";
import VueCookies from 'vue-cookies'
import VueRouter from 'vue-router'
import Vuex from 'vuex';
import vuelidate from 'vuelidate';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrash,faPlus, faLink, faUser, faBold, faItalic, faStrikethrough, faCode, faUndo, faRedo, faUnderline, faListUl, faListOl, } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import vmodal from 'vue-js-modal'
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';

import Login from './components/Login'
import Pytanka from './components/PytankaCopy'
import SetTest from './components/SetTest'
import Welcome from './components/Welcome'
import App from './components/App'
import Register from './components/Register';
import Wyniki from './components/WynikiZapisane';
import PageNotFound from './components/PageNotFound';
import OneGroup from './components/Groups/OneClassroom'
import ListGroups from './components/Groups/Classrooms';
import GroupsMain from './components/GroupsMain';
import Tests from './components/Tests.vue'
import Dodawanko from './components/AddDzial'


library.add(faTrash, faPlus, faLink, faUser, faBold, faItalic, faStrikethrough, faCode, faUndo, faRedo, faUnderline, faListUl, faListOl);
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(VueCookies)
Vue.use(VueRouter)
Vue.use(VueSpinnersCss);
Vue.use(Vuex);
Vue.use(vmodal);
Vue.use(Datetime);
Vue.use(vuelidate);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
const store = new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        }
    }
})

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
        props: { ilosc: 40 }
    },
    {
        path: '/losowanie1',
        name: 'losowanie1',
        component: Pytanka,
        props: { ilosc: 1 }
    },
    {
        path: '/groups',
        name: 'TeacherGroups',
        component: GroupsMain,
        redirect: '/groups/home',

        children: [
            {
                path: "/groups/home",
                name: 'GroupsHome',
                component: ListGroups,
            },
            {
                path: "/groups/id/:id",
                props: true,
                component: OneGroup,
            },
        ]

    },
    {
        path: '/tests',
        component: Tests
    },
    {
        path: "/user/wyniki",
        name: "wynikiUcznia",
        component: Wyniki,
        beforeEnter: (to, from, next) => {
            if (!store.state.user) {
                next('/login')
            } else {
                next()
            }
        }

    },
    {
        path: "/test/:id",
        props: true,
        component: SetTest
    },
    {
        path: '/nowydzial',
        component: Dodawanko
    },
    {
        path: "*",
        component: PageNotFound
    }

];
const router = new VueRouter({
    mode: 'history',
    routes,
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router
});


