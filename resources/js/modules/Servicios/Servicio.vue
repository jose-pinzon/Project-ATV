<template>
    <div class="col-lg-12">
      <div class="card">
        <div v-if="table">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Servicios de tours <button class="btn btn-info" hidden>Nuevo</button></h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th hidden>ID</th>
                  <th>Servicio</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="servicio in servicios" :key="servicio.id_servicio">
                  <td hidden><a href="#" >{{servicio.id_servicio}}</a></td>
            
                  <td>{{servicio.servicio}}</td>
                  <td>{{servicio.descripcion}}</td>
                  <td>$ {{servicio.precio}}</td>

                  <td>
                      <button type="button" hidden @click="DetallesServicio(servicio)" class="btn btn-sm btn-primary">Detales</button>
                      <button type="button" @click="editServicio(servicio)" class="btn btn-sm btn-warning">Editar</button>
                  </td>
                </tr> 
              </tbody>
            </table>
      
          </div>
      </div>
      
      <div  v-if="form==1">
       
          <div class="card mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==1">Nuevo servicio</h6>
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==2">Editar servicio</h6>
              
              
            </div>
              <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error">{{error}}</p></center>
            <div class="card-body">
               
                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Servicio</label>
                    <input type="text" class="form-control" placeholder="Nombre del servicio" v-model="servicio">
                    
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Descripcion</label>
                    <input type="text" class="form-control" placeholder="Descripcion del servicio" v-model="descripcion">
                    
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Precio</label>
                    <input type="text" class="form-control" placeholder="Precio del servicio" v-model="precio">
                    
                  </div>
                </div>
                 <hr>
                <button class="btn btn-danger" @click="cancelar()">Cancelar</button>
  
                <button class="btn btn-primary"  v-if="bandera==1">Registrar</button>
                <button class="btn btn-primary"  v-if="bandera==2" @click="updateServicio()">Actualizar</button>
  
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
              <h5 class="modal-title" id="exampleModalLabel">Detalles del servicio</h5>
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
                          <th></th> 
                        </tr>
                        <tr>
                          <th></th>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirDetalles()">Salir</button>
              <button type="button" class="btn btn-primary" >Editar</button>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </template>
  
  <script>  
  const moment = require('moment');

  export default {
      data(){
          return{
            servicios:[],
            id_servicio:0,
            servicio:'',
            descripcion:'',
            precio:0.0,
            estado:0,
            //varaibles interfaz
            table:1,
            form:0,
            bandera:1,
            //variables de validacion
            errortext:'',
            error:0,
            arrayError:[],
            moment: function(){
                return moment();
            },
            
          }
      },

      methods:{
          getServicios(){
              let e = this;
              let url = '/servicios/index';
  
              axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
  
                e.servicios = respuesta;
  
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });
          },
          
          createServicio(){
            const e = this;
            e.table=0;
            e.estado=0;
            e.form=1;
            e.bandera=1;
          },
          validarInputs(){
            this.error = 0;
            this.arrayError = [];
            
            if(!this.servicio) this.arrayError.push('El servicio es requerido');
            if(!this.precio) this.arrayError.push('El precio del servicio es requerido ');
            
            if(this.arrayError.length) this.error=1;
  
            return this.error;
            //console.log(this.arrayError)
  
          },
          
          storeServicio(){
            
            if(this.validarInputs()){
              return;
            }
             
            let e = this;  
            let url = '';

            var arrayServicio= {
             
            };

            axios.post(url, arrayHorario).then(function (response) {
              // handle success
              e.form=0;
              e.table=1;
  
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
  
          },
          cancelar(){
            const e = this;
            e.table=1;
            e.form=0;
            e.bandera=1;
            e.servicio = "";
            e.descripcion = "";
            e.precio = 0.0;
            e.estado=0;
            e.arrayError=[];
          },
          DetallesServicio(data=[]){
           
          },
          salirDetalles(){
            
          },
          editServicio(data=[]){
            $("#detalles").modal('hide');
            this.table=0;
            this.form=1;
            this.bandera=2;
            this.id_servicio = data['id_servicio'];
            this.servicio = data['servicio'];
            this.descripcion = data['descripcion'];
            this.precio = data['precio'];
          },
          updateServicio(){
            if(this.validarInputs()){
              return;
            }
  
            let e = this;  
            let url = '/servicios/update';
    
            var arrayServicio = {
              'servicio':this.servicio,
              'descripcion':this.descripcion,
              'precio':this.precio,
              'id_servicio':this.id_servicio
            };
            axios.put(url, arrayServicio).then(function (response) {
              // handle success
              e.id_servicio = 0;
              e.servicio = "";
              e.descripcion = "";
              e.precio = 0.0;
              e.form=0;
              e.table=1;
              e.getServicios();
  
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          },  
          
      },
      mounted(){
        this.getServicios();
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
  </style>
  
  