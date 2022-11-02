<template>
    <div class="col-lg-12">
      <div class="card">
        <div v-if="table">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Ingresos de tours</h6>
          </div>
          <div class="table-responsive">
            
            <div class="form-group row" id="navegador">
                <div class="col-md-10">
                  <form method="post" :action="action">
  
                    <input type="hidden" name="_token" v-bind:value="csrf">
               
                    <div class="input-group">
                    
                        <input type="date" class="form-control" required name="fecha_1" v-model="fecha_inicial"> <span>A</span>
                        <input type="date" class="form-control"   :min="date()" required name="fecha_2" v-model="fecha_final">
                        <!-- <button type="button"  class="btn btn-primary" ><i class="fa fa-search"></i> Buscar</button> -->
                        <button type="button"  class="btn btn-info" style="margin-left:10px" @click="getIngresos(1)">Hoy</button>
                        <button type="button" class="btn btn-info" style="margin-left:10px" @click="AllIngresos(1)">Todos</button>
                        <button class="btn btn-danger" style="margin-left:10px" type="submit"><i class="fas fa-file-pdf"></i></button>
                        <!-- pendiente logica en futuras actualizaciones -->
                        <button class="btn btn-success" style="margin-left:10px" hidden>Excel</button>
                     
                    </div>
                  </form>
                </div>
            </div>
  
            
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th hidden>ID</th>
                  <th>Fecha</th>
                  <th>Comentario</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Forma pago</th>
                  <th>Movimiento</th>
                  <th>Detalles</th>
                </tr>
              </thead>
              <tbody v-if="filtrarRango.length">
           
                  <tr v-for="ingreso in filtrarRango" :key="ingreso.id_ingreso">
                  <td hidden><a href="#" >{{ingreso.id_ingreso}}</a></td>
                  <td>{{moment(ingreso.fecha_hora).format('DD-MM-YYYY')}}</td>
                  <td>{{ingreso.descripcion}}</td>
                  <td>{{ingreso.cantidad}}</td>
                  <td>$ {{ingreso.total}}</td>
                  <td>{{ingreso.forma_pago}}</td>
                  <td>{{ingreso.mov_banco}}</td>
                  <td> 
                      <a :href="'reserva/reporte/'+ ingreso.slug" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></a>
                  </td>
                </tr>   
              </tbody>
              <tbody v-else>
                  <tr colspan="10"> 
                   <td><strong>Sin reservas</strong></td>
                  </tr>
              </tbody>
            </table>
            <nav id="navegador" v-if="nav==1">
               
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                    </li>
  
                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                    </li>
                  
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                    </li>
                </ul>
            </nav>
          </div>
      </div>
  
      </div> 
     
    </div>
  </template>
  
  <script>  
  const moment = require('moment');
  
  //vue select
  import vSelect from 'vue-select';
  
  
  import 'vue-select/dist/vue-select.css';
  
  export default {
      props:['action','csrf'],
      data(){
          return{
            //array captura reservas
            ingresos:[],
            id_reserva:0,
            id_detalle_reserva:0,
            //varaibles interfaz
            table:1,
            form:0,
            bandera:1,
            nav:0,
            //VARIABLES PAGINACION
            pagination : {
                  'total' :0,
                  'current_page' : 0,
                  'per_page' : 0,
                  'last_page' : 0,
                  'from' : 0,
                  'to' : 0
              },
            //inputs rango fecha
            fecha_inicial:'',
            fecha_final:'',
            //metdo date
            date:function(){
               let date = new Date();
  
               let resultado = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
          
               return resultado;
            },
            moment:function(){
                return moment();
            }
          }
      },
  
      components:{
  
        vSelect,
  
      },
  
      computed:{
        //metodo para la paginacion 
        isActived: function(){
                return this.pagination.current_page;
        },
        //calculos de los elmentos de la paginacion
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }
  
            var from = this.pagination.current_page - this.offset;
  
            if(from < 1){
                from = 1;
            }
  
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
  
            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
  
            return pagesArray;
  
        },
        //fin metodos para la paginacion 
        filtrarRango(){
          if(!this.fecha_inicial && !this.fecha_final){
            return this.ingresos;
           
          }else{
            
            return this.ingresos.filter(R=>R.fecha_hora >= this.fecha_inicial && R.fecha_hora <= this.fecha_final);
         
          }
        },
      },
  
      methods:{
          //trae reservas actuales
          getIngresos(){
              let e = this;
              e.fecha_inicial='';
  
              e.fecha_final='';
  
              let url = '/ingresos/index';
  
              axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
  
                e.ingresos = respuesta.ingresos.data;
  
                e.nav=0;
  
               //e.pagination = respuesta.pagination;
  
                //console.log(respuesta);
  
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });
  
              //console.log(arrayFechas);
              
  
          },
          //traer todas las reservas
          AllIngresos(page){
              let e = this;
              
              e.reservas = [];
  
              let url = '/ingresos/all?page=' + page ;
  
              axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
  
                e.ingresos = respuesta.ingresos.data;
  
                e.pagination = respuesta.pagination;
  
                e.nav=1;
                //console.log(respuesta);
  
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });
          },
  
          //metodo paginaion 
          cambiarPagina(page){
              let me = this;
              //actualiza la pagina actual
              me.pagination.current_page = page;
  
              //envia la peticion para visualizar la data en la vista
              //el page lo recibe el metodo de lista cat
              //me.getReservas(page);
  
              me.AllIngresos(page);
          },
          
          
      },
      mounted(){
        this.getIngresos();
      },
  }
  </script>
  
  <style>
    #navegador{
      margin-left: 20px;
    }
    .flex{
      display: flex;
    }
    .estado{
        cursor: pointer;
    }
    .v-select{
      border: none;
  
    }
  </style>
  
  