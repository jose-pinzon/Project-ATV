/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import App from './components/App.vue'

// main.js
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// importar axios
import VueAxios from 'vue-axios';
import axios from 'axios';

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2, options);


// If you don't need the styles, do not connect





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('table-component', require('./modules/Egresos/views/Table.vue').default);
Vue.component('moment', require('./components/moments.vue').default);
Vue.component('agregar-egreso', require('./modules/Egresos/views/agregarEgreso.vue').default);
Vue.component('tabla-egresos', require('./modules/Egresos/views/TablaEgreso.vue').default);
Vue.component('egresos-xmotos', require('./modules/Egresos/views/EgresosXMoto').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});

