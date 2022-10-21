require('./bootstrap');
window.Vue = require('vue').default;
//importando
import axios from 'axios';
Vue.use(axios);
//componentes
Vue.component('table-component', require('./modules/Egresos/views/Table.vue').default);
Vue.component('clientes-component', require('./modules/Clientes/Cliente.vue').default);
Vue.component('guias-component', require('./modules/Guias/Guia.vue').default);
Vue.component('horarios-component', require('./modules/Horarios/Horario.vue').default);
Vue.component('reserva-component', require('./modules/Reserva/Reserva.vue').default);
//estructura vue js

const app = new Vue({
    el: '#app',
    data:{
  
    }
   
});
