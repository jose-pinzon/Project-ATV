require('./bootstrap');
window.Vue = require('vue').default;
//importando
import axios from 'axios';
import Vue from 'vue';
Vue.use(axios);

//componentes
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

const app = new Vue({
    el: '#app',
    data:{

    }

});
