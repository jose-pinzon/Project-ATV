require('./bootstrap');
window.Vue = require('vue').default;
//importando
// import axios from 'axios';
// Vue.use(axios);
//componentes
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
Vue.component('clientes-component', require('./modules/Clientes/Cliente.vue').default);
Vue.component('guias-component', require('./modules/Guias/Guia.vue').default);
Vue.component('horarios-component', require('./modules/Horarios/Horario.vue').default);
Vue.component('reserva-component', require('./modules/Reserva/Reserva.vue').default);
Vue.component('servicios-component',require('./modules/Servicios/Servicio.vue').default);
Vue.component('ingresos-component',require('./modules/Ingresos/Ingreso.vue').default);

Vue.component('moment', require('./components/moments.vue').default);
Vue.component('agregar-egreso', require('./modules/Egresos/views/agregarEgreso.vue').default);
Vue.component('tabla-egresos', require('./modules/Egresos/views/TablaEgreso.vue').default);
//estructura vue js
Vue.component('egresos-xmotos', require('./modules/Egresos/views/EgresosXMoto').default);

const app = new Vue({
    el: '#app',
    data:{

    }

});
