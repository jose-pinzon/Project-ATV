require('./bootstrap');
window.Vue = require('vue').default;
//importando
import axios from 'axios';
Vue.use(axios);
//componentes
Vue.component('table-component', require('./modules/Egresos/views/Table.vue').default);
Vue.component('clientes-component', require('./modules/Clientes/Cliente.vue').default);
//estructura vue js

const app = new Vue({
    el: '#app',
    data:{
    menu:0,
    }
   
});
