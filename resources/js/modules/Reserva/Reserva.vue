<template>
  <div class="col-lg-12">
    <div class="card">
      <div v-if="table">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Reservas de motos<button class="btn btn-info" v-on:click="createReserva">Nuevo</button></h6>
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
                      <button type="button"  class="btn btn-info" style="margin-left:10px" @click="getReservas(1)">Hoy</button>
                      <button type="button" class="btn btn-info" style="margin-left:10px" @click="AllReservas(1)">Todos</button>
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
                <!-- <th>Horario</th> -->
                <th>Cliente</th>
                <th>Telefono</th>
                <th>Guia</th>
                <th>Estado</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody v-if="filtrarRango.length">
         
                <tr v-for="reserva in filtrarRango" :key="reserva.id_reserva">
                <td hidden><a href="#" >{{reserva.id_reserva}}</a></td>
                <td>{{reserva.fecha_reserva}}</td>
                <!-- <td>{{reserva.start}} - {{reserva.end}}</td> -->
                <td>{{reserva.nombre_cliente}} {{reserva.apellido_cliente}}</td>
                <td>{{reserva.telefono_cliente}}</td>
                <td>{{reserva.nombre_guia}} {{reserva.apellido_guia}}</td>
                <template v-if="reserva.estado=='PENDIENTE'">
                  <td><span class="badge badge-warning">PENDIENTE</span></td>
                </template>
                <template v-else>
                  <td><span class="badge badge-success">REALIZADO</span></td>
                </template>  
                <td>
                    <button type="button" class="btn btn-sm btn-primary" @click="DetallesReserva(reserva)"><i class="fas fa-info-circle"></i></button>
                    <button type="button"  class="btn btn-sm btn-warning" @click="editReserva(reserva)" v-if="reserva.estado=='PENDIENTE'"><i class="fas fa-edit"></i></button>
                    <a :href="'reserva/reporte/'+ reserva.slug" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></a>
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
    
    <div  v-if="form==1">
     
        <div class="card mb-3">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==1">Nueva reserva</h6>
            <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==2">Editar reserva</h6>
            
          </div>
            <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error">{{error}}</p></center>
          <div class="card-body">
             <div class="form-row">

              <!-- capturo los precio de los servicios desde una conulta  -->
                <p hidden>{{precioDoble=servicioDoble.precio}}</p>
                <p hidden>{{precioSencillo=servicioSencillo.precio}}</p>
    
                <div class="col">
                  
                  <label for="exampleInputPassword1">Fecha de reserva </label>
                  <input type="date" id="date" :min="date()" class="form-control" placeholder="" v-model="fecha_reserva">
                  
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Horario</label>
                  <select class="form-control" v-model="id_horario">
                    <option value="0" disabled>Asigna un horario</option>
                    <option v-bind:value="horario.id_horario" v-for="horario in horarios" :key="horario.id_horario">{{horario.start.split(':').slice(0,2).join(':')}} - {{horario.end.split(':').slice(0,2).join(':')}}</option>
                  </select>
                </div>
            
              </div> 
              <div class="form-row">
                
                <div class="col">
                  <label for="exampleInputPassword1">Simple </label>
                  <input type="number" class="form-control" placeholder="" v-model="sencillo" value="0">
                  
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Doble</label>
                  <input type="number" class="form-control" placeholder="" v-model="doble" value="0">
                  
                </div>

                <div class="col">
                  <label for="exampleInputPassword1">Guia </label>
                  <select class="form-control" v-model="id_guia">
                    <option value="0" disabled>Asigna un guia</option>
                    <option v-bind:value="guia.id_guia" v-for="guia in guias" :key="guia.id_guia">{{guia.nombres}} {{guia.apellidos}}</option>
                  </select>  
                </div>
              
              </div>

              <label for="exampleInputPassword1">Cliente</label>
              <div class="input-group mb-2">
              
                <v-select class="form-control v-select"
                  @search="selectCliente"
                  label="nombres"
                  v-model="nombres"
                  :options="clientes"
                  placeholder="Buscar cliente"
                  @input="CaptureValor"
                  ></v-select>

                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" @click="createCliente()">Nuevo cliente</button>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Comentario </label>
                 <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="comentario"></textarea>
                  
                </div>  
              </div>

              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Descuento</label>
                  <input type="number" class="form-control" placeholder="" v-model="descuento" >
                  
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Total:</label>

                  <!-- operacion matematica suma de valores -->
                  <p hidden>{{total=((sencillo*precioSencillo) + (doble * precioDoble) - descuento).toFixed(2)}}</p>

                  <input type="number" class="form-control" placeholder="" v-model="total" disabled>
                  
                </div>
              </div>
            
               <hr>
              <button class="btn btn-danger" @click="cancelar()">Cancelar</button>

              <button class="btn btn-primary" @click="storeReserva()" v-if="bandera==1">Registrar</button>
              <button class="btn btn-primary"  v-if="bandera==2" @click="updateReserva()">Actualizar</button>

          </div>
        </div>
    </div>

    <div  v-if="formCliente==1">
     <div class="card mb-3">
       <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <h6 class="m-0 font-weight-bold text-primary">Nuevo cliente</h6>  
       </div>
         <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error">{{error}}</p></center>
       <div class="card-body">
            <div class="form-row">
              <div class="col">
                <label for="exampleInputPassword1">Nombres</label>
                <input type="text" class="form-control" placeholder="Nombres" v-model="nombresCliente">
                
              </div>
              <div class="col">
                <label for="exampleInputPassword1">Apellidos</label>
                <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidos">
                
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="exampleInputPassword1">Telefono</label>
                <input type="text" class="form-control" maxlength="10" placeholder="- - - - - - - - - -" v-model="telefono">
                
              </div>
              <div class="col">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" placeholder="@correo.com" v-model="email">
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="exampleInputPassword1">Nacionalidad</label>
                <input type="text" class="form-control" placeholder="Nacionalidad" v-model="nacionalidad">
              </div>
              <div class="col">
                <label for="exampleInputPassword1">Pais</label>
                <input type="email" class="form-control" placeholder="Pais" v-model="pais">
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="exampleInputPassword1">Ciudad</label>
                <input type="text" class="form-control" placeholder="Ciudad" v-model="ciudad">
              </div> 
            </div>
         
           <hr>
           <button class="btn btn-danger" @click="cerraCreateCliente()">Cancelar</button>

           <button class="btn btn-primary" @click="storeCliente()" >Registrar</button>
    
       </div>
     </div>
    </div>

    </div> 

    <!-- Modal detalles-->
    <div class="modal fade" id="detalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de la reserva</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="salirDetalles">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <div class="col-12">
                <table class="table table-striped">
                    <tbody>
                      <tr>
                        <th>Horario: De {{start}} a {{end}}</th> 
                      </tr>
                      <tr>
                        <th>Sencillos : {{sencillo}} - Dobles: {{doble}}</th>
                      </tr>
                      <tr>
                        <th>Comentario: <br> {{comentario}}</th>
                      </tr>
                      <tr>
                        <th>Descuento: ${{descuento}}</th>
                      </tr>
                      <tr>
                        <th>Total: ${{total}}</th>
                      </tr>
                     
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirDetalles()">Salir</button>
            
            <button type="button" class="btn btn-success" v-if="estado=='PENDIENTE'" @click="modalVender(arrayDetalleReserva)">Vender</button>

          </div>
        </div>
      </div>
    </div>

     <!-- Modal vender-->
     <div class="modal fade" id="vender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Realizar venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="CerrarModalVender">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="col">
                <label for="exampleInputPassword1">Total a pagar</label>
                <input type="text" class="form-control" placeholder="Total" disabled v-model="total">
              </div>
              <div class="col">
                <label for="exampleInputPassword1">Metodo de pago</label>
                <select name="" id="" class="form-control" v-model="formapago">
                  <option value="0" disabled>Elige metodo de pago</option>
                  <option value="EFECTIVO">EFECTIVO</option>
                  <option value="TARJETA">TARJETA</option>
                  <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                </select>
              </div>
            </div>

            <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Descripcion</label>
                  <textarea name="" id="" cols="" rows="5" class="form-control" v-model="descripcion">

                  </textarea>
                </div>
                <!-- //movimiento de banco -->
                <div class="col" v-if="formapago!='EFECTIVO'">
                  <label for="">Movimiento</label>
                  <input type="text" class="form-control" placeholder="N° Operacion" v-model="mov_banco">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="CerrarModalVender()">Salir</button>
            
            <button type="button" class="btn btn-success" @click="vender()">Listo</button>

          </div>
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
          reservas:[],
          //array capturan servicios
          servicioSencillo:[],
          servicioDoble:[],
          //array que caprura horarios
          horarios:[],
          //array que captura guias
          guias:[],
          //array clientes
          clientes:[],
          //array caprura detalles reserva
          arrayDetalleReserva:[],
          //variables del usuario
          fecha_reserva:'',
          id_horario:0,
          sencillo:0,
          doble:0,
          //variables que capturan el precio en los array de servicios
          precioSencillo:0.0,
          precioDoble:0.0,
          //variables del usuario
          id_guia:0,
          id_cliente:0,
          //variable valor de select
          nombres:'',
          //
          comentario:'',
          descuento:0,
          total:0.0,
          estado:'',
          id_reserva:0,
          id_detalle_reserva:0,
          //varaibles interfaz
          table:1,
          form:0,
          bandera:1,
          nav:0,
          formCliente:0,
          //variables de validacion
          errortext:'',
          error:0,
          arrayError:[],
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
          date:function(){
             let date = new Date();

             let resultado = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
        
             return resultado;
          },
          start:'',
          end:'',
          //variables para crear clientes
          nombresCliente:'',
          apellidos:'',
          telefono:'',
          email:'',
          nacionalidad:'',
          pais:'',
          ciudad:'',
          //variables ventas
          formapago:'EFECTIVO',
          descripcion:'',
          m_banco:'',
          cantidad_ingreso:0,
        
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
          return this.reservas;
         
        }else{
          
          return this.reservas.filter(R=>R.fecha_reserva >= this.fecha_inicial && R.fecha_reserva <= this.fecha_final);
       
        }
      },
    },

    methods:{
        //trae reservas actuales
        getReservas(){
            let e = this;
            e.fecha_inicial='';

            e.fecha_final='';

            let url = '/reservas/index';

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.reservas = respuesta.reservas.data;

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
        AllReservas(page){
            let e = this;
            
            e.reservas = [];

            let url = '/reservas/all?page=' + page ;

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.reservas = respuesta.reservas.data;

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

            me.AllReservas(page);
        },
        
        //activa formulario
        createReserva(){
          const e = this;
          e.table=0;
          e.bandera=1;
          e.fecha_reserva='';
          e.id_horario=0;
          e.id_cliente=0;
          e.nombres='';
          e.sencillo=0;
          e.doble=0;
          e.id_guia=0;
          e.comentario='';
          e.descuento=0;
          e.total=0.0;
          e.estado='';
          e.form=1;
          e.getDatosServicio();
          e.getSelectHorarios();
          e.getSelectGuias();
        },
        //traer datos de servicios
        getDatosServicio(){
          let e = this;
            
            let url = '/capture/servicios';

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.servicioSencillo = response.data.serviciosSencillos;
              e.servicioDoble = response.data.serviciosDobles;
    
              //console.log(e.servicioDoble);

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
        },
        //extrae horarios
        getSelectHorarios(){
            let e = this;
            
            let url = '/horarios/select';

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.horarios = respuesta;
    
              //console.log(respuesta);

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
        },
        //extrae guias
        getSelectGuias(){
          let e = this;
            
            let url = '/guias/select';

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.guias = respuesta;
    
              //console.log(respuesta);

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
        },

         //select cliente con v-select
        selectCliente(search,loading){

            let atrapar = this;

            loading(true)

            var url ='/clients/select?filtro=' + search;

            axios.get(url).then(function (json) {
                var  respuesta = json.data;

                q:search

                atrapar.clientes = respuesta.clientes;

                let array = respuesta.clientes;

                //atrapar.getDatosCliente(array);
                //console.log(respuesta);
                loading(false)

            })
            .catch(function (json) {
                
                console.log(error);
            });

        },
        //el metodo select, para ello se uso el @input y un metodo en especifico del vue select
        CaptureValor(val){
          let me = this;
          me.loading = true;

          me.id_cliente = val.id_cliente; 
          //me.cliente = val.nombre;

        },

        validarInputs(){
          this.error = 0;
          this.arrayError = [];
          
          if(!this.fecha_reserva) this.arrayError.push('La fecha es necesario');
          if(this.id_horario==0) this.arrayError.push('El horario es necesario');
          //if(this.sencillo == 0) this.arrayError.push('Elija un valor mayor que 0 para motos sencillos');
          //if(this.doble == 0) this.arrayError.push('Elija un valor mayor que 0 para motos dobles');
          if(this.id_guia==0) this.arrayError.push('El guia es necesario');
          if(this.id_cliente==0) this.arrayError.push('El cliente es necesario');
          if(this.descuento < 0) this.arrayError.push('Es necesario un valor correcto para el descueto');
          if(this.total==0) this.arrayError.push('La cantidad tiene que ser mayor que cero');
          if(this.arrayError.length) this.error=1;

          return this.error;
          //console.log(this.arrayError)

        },
        //guardar reserva
        storeReserva(){
          if(this.validarInputs()){
            return;
          }     
          let e = this;  
          let url = '/reservas/store';

          var arrayReserva = {
            'fecha_reserva':this.fecha_reserva,
            'id_horario':this.id_horario,
            'sencillo':this.sencillo,
            'precio_sencillo':this.precioSencillo,
            'doble':this.doble,
            'precio_doble':this.precioDoble,
            'id_guia':this.id_guia,
            'id_cliente':this.id_cliente,
            'comentario':this.comentario,
            'descuento':this.descuento,
            'total':this.total
          };

          axios.post(url, arrayReserva).then(function (response) {
            // deja vacio
            e.fecha_reserva="";
            e.id_horario=0;
            e.sencillo=0;
            e.precioSencillo=0.0;
            e.doble=0;
            e.precioDoble=0.0;
            e.id_guia=0;
            e.id_cliente=0;
            e.comentario="";
            e.descuento=0;
            e.total=0.0;
            e.form=0;
            e.table=1;
            e.arrayError=[];
            e.getReservas();
           
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });

        },
        //cancelar form reservas
        cancelar(){
          const e = this;
          e.table=1;
          e.form=0;
          e.bandera=1;
          this.fecha_reserva="";
          this.id_horario=0;
          this.sencillo=0;
          this.precioSencillo=0.0;
          this.doble=0;
          this.precioDoble=0.0;
          this.id_guia=0;
          this.id_cliente=0;
          this.comentario="";
          this.descuento=0;
          this.total=0.0;
          e.estado='';
          e.arrayError=[];
        },
        //detalles de la reserva
        DetallesReserva(data=[]){
          //captura el data en un array 
          this.arrayDetalleReserva=data;
          //paso parametros en moment
          var h1 = moment(data['start'],'hh:mm:ss');
          var h2 = moment(data['end'],'hh:mm:ss');
          //asigno un formato
          this.start = h1.format('hh:mm a');
          this.end = h2.format('hh:mm a');
          this.doble=data['doble'];
          this.sencillo = data['sencillo'];
          this.comentario = data['comentario'];
          this.descuento = data['descuento'];
          this.total= data['total'];
          this.estado=data['estado'];
           $("#detalles").modal('show');
        },
        //salir de detalles
        salirDetalles(){
          const e = this;
          e.start= "";
          e.end = "";
          e.sencillo=0;
          e.doble=0;
          e.comentario='';
          e.descuento=0.0;
          e.total=0.0;
          e.id_horario = 0;
          e.estado='';
          this.arrayDetalleReserva=[];
          $("#detalles").modal('hide');
        },
        //editar la reserva
        editReserva(data=[]){
          $("#detalles").modal('hide');
          this.table=0;
          this.form=1;
          this.bandera=2;
          this.getDatosServicio();
          this.getSelectHorarios();
          this.getSelectGuias();
          this.fecha_reserva=data['fecha_reserva'];
          this.id_horario=data['id_horario'];
          //this.precioSencillo=data['precio_sencillo'];
          this.sencillo = data['sencillo'];
          //this.precioDoble=data['precio_doble'];
          this.doble=data['doble'];
          this.id_guia = data['id_guia'];
          this.nombres= data['nombre_cliente'];
          this.id_cliente = data['id_cliente'];
          this.comentario=data['comentario'];
          this.descuento = data['descuento'];
          this.total= data['total'];
          //capturo ids reservas y detalles reservas
          this.id_reserva = data['id_reserva'];
          this.id_detalle_reserva = data['id_detalle_reserva'];
          //console.log(data)
        },
        //actualiza la reserva
        updateReserva(){
          if(this.validarInputs()){
            return;
          }

          let e = this;  
          let url = '/reservas/update';

          var arrayReserva = {
            'fecha_reserva':this.fecha_reserva,
            'id_horario':this.id_horario,
            'sencillo':this.sencillo,
            'precio_sencillo':this.precioSencillo,
            'doble':this.doble,
            'precio_doble':this.precioDoble,
            'id_guia':this.id_guia,
            'id_cliente':this.id_cliente,
            'comentario':this.comentario,
            'descuento':this.descuento,
            'total':this.total,
            'id_reserva':this.id_reserva,
            'id_detalle_reserva':this.id_detalle_reserva
          };

          axios.put(url, arrayReserva).then(function (response) {
            // handle success
            e.fecha_reserva="";
            e.id_horario=0;
            e.sencillo=0;
            e.precioSencillo=0.0;
            e.doble=0;
            e.precioDoble=0.0;
            e.id_guia=0;
            e.id_cliente=0;
            e.comentario="";
            e.descuento=0;
            e.total=0.0;
            e.form=0;
            e.table=1;
           
            e.getReservas();

          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },
        //cambia el estado de la reserva
        updateEstado(){
          
          let e = this;  
          let url = '/reservas/updateEstado';
     
          var arrayReserva = {
            'id_reserva':this.id_reserva,
            'id_detalle_reserva':this.id_detalle_reserva
          };

          axios.put(url, arrayReserva).then(function (response) {
            // handle success
          
            e.getReservas();

          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },
        //validar inputs form clientes
        validarInputsCliente(){
          this.error = 0;
          this.arrayError = [];
          
          if(!this.nombresCliente) this.arrayError.push('los nombres son requeridos');
          if(!this.apellidos) this.arrayError.push('los apellidos son requeridos');
          if(!this.telefono) this.arrayError.push('El telefono es requeridos');       
          
          if(this.arrayError.length) this.error=1;

          return this.error;
          //console.log(this.arrayError)

        },
        //create nuevo cliente 
        createCliente(){
          this.nombresCliente='';
          this.apellidos='';
          this.telefono='';
          this.email='';
          this.nacionalidad='';
          this.pais='';
          this.ciudad='';
          this.formCliente=1;
          this.form=0;
          this.arrayError=[];
        },
        //cerrar form de create cliente
        cerraCreateCliente(){
          this.nombresCliente='';
          this.apellidos='';
          this.telefono='';
          this.email='';
          this.nacionalidad='';
          this.pais='';
          this.ciudad='';
          //console.log('funciona')
          this.formCliente=0;
          this.form=1;
          this.arrayError=[];
        },
        //crea un nuevo cliente
        storeCliente(){
          if(this.validarInputsCliente()){
            return;
          }

          let e = this;  
          let url = '/clients/store';
          var arrayCliente = {
            'nombres':this.nombresCliente,
            'apellidos':this.apellidos,
            'telefono':this.telefono,
            'email':this.email,
            'nacionalidad':this.nacionalidad,
            'pais':this.pais,
            'ciudad':this.ciudad
          };
          axios.post(url, arrayCliente).then(function (response) {
            // handle success
            // e.selectCliente();
            let respuesta = response.data;
            e.nombres = respuesta.nombres;
            e.id_cliente=respuesta.id_cliente;
            //dejo vacios campos
            e.nombresCliente = "";
            e.apellidos = "";
            e.telefono = "";
            e.email = "";
            e.nacionalidad = "";
            e.pais = "";
            e.ciudad = "";
            e.formCliente=0;
            e.form=1;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });

        },
        //createVender
        modalVender(data=[]){
          //console.log(data);
          $("#detalles").modal('hide');
          $("#vender").modal('show');
          this.total=data['total'];
          this.id_reserva=data['id_reserva'];
          this.id_detalle_reserva=data['id_detalle_reserva'];
          this.cantidad_ingreso = data['sencillo'] + data['doble'];
        },
        CerrarModalVender(){  
          $("#vender").modal('hide');
          this.arrayDetalleReserva=[];
          this.total=0.0;
          this.id_reserva=0;
          this.id_detalle_reserva=0;
          this.formapago='TARJETA';
        },
        vender(){
         
          let e = this;  
          let url = '/ingreso/store';

          var arrayIngreso = {
            'descripcion':this.descripcion,
            'cantidad':this.cantidad_ingreso,
            'forma_pago':this.formapago,
            'mov_banco':this.mov_banco,
            'pago_unitario':this.total,
            'total':this.total,
            'id_detalle_reserva':this.id_detalle_reserva
          };

          axios.post(url, arrayIngreso).then(function (response) {
            // deja vacio
            e.descripcion='';
            e.cantidad_ingreso=0;
            e.forma_pago = 'EFECTIVO';
            e.mov_banco = '';
            e.total=0.0;
            e.id_detalle_reserva=0;
            $("#vender").modal('hide');
            e.updateEstado();
            if(this.reservas.length){
              e.AllReservas();
            }else{
              e.getReservas();
            }
           
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
         
        },
        pdfReporte(){
          let e = this;  
          let url = '/reservas/reporte/all';
          var arrayFechas = {
            'fecha_inicial':this.fecha_inicial,
            'fecha_final':this.fecha_final,
          };
          axios.get(url, arrayFechas).then(function (response) {
            
      
        
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        }
        
    },
    mounted(){
      this.getReservas();
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

