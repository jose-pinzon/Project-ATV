<template>
    <div class="col-lg-12">
      <div class="card">
        <div v-if="table">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Horarios de tours <button class="btn btn-info" v-on:click="createHorario">Nuevo</button></h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>ID</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Estatus</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="horario in horarios" :key="horario.id_horario">
                  <td><a href="#" @click="editHorario(horario)">{{horario.id_horario}}</a></td>
            
                  <td>{{horario.start}}</td>
                  <td>{{horario.end}}</td>

                  <template v-if="horario.estado">
                 
                        <td class="estado" @click="desactivar(horario.id_horario)"><span class="badge badge-success">Activo</span></td>
                 
                  </template>
                  <template v-else>
                
                        <td class="estado" @click="activar(horario.id_horario)"><span class="badge badge-danger">Inactivo</span></td>
           
                  </template>

                  <td>
                      <button type="button" @click="DetallesHorario(horario)" class="btn btn-sm btn-primary">Detales</button>
                      <button type="button" @click="editHorario(horario)" class="btn btn-sm btn-warning">Editar</button>
                  </td>
                </tr> 
              </tbody>
            </table>
      
          </div>
      </div>
      
      <div  v-if="form==1">
       
          <div class="card mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==1">Nuevo horario</h6>
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==2">Editar horario</h6>
              
              <strong><span style="color:red">Important!: </span>(Acomode su horario de manera organizada, sin horas repetetivas)</strong>
            </div>
              <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error">{{error}}</p></center>
            <div class="card-body">
               
                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Hora inicial</label>
                    <input type="time" class="form-control" placeholder="" v-model="start">
                    
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Hora final</label>
                    <input type="time" class="form-control" placeholder="" v-model="end">
                    
                  </div>
                </div>
                 <hr>
                <button class="btn btn-danger" @click="cancelar()">Cancelar</button>
  
                <button class="btn btn-primary" @click="storeHorario()" v-if="bandera==1">Registrar</button>
                <button class="btn btn-primary"  v-if="bandera==2" @click="updateHorario()">Actualizar</button>
  
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
              <h5 class="modal-title" id="exampleModalLabel">Detalles del horario</h5>
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
                          <th>Hora inicial: {{start}}</th> 
                        </tr>
                        <tr>
                          <th>Hora final: {{end}}</th>
                        </tr>
                        <tr>
                            <template v-if="estado">
                 
                            <td class="estado" >Estado: <span class="badge badge-success"> Activo</span></td>
                            
                            </template>
                            <template v-else>
                            
                            <td class="estado" >Estado: <span class="badge badge-danger"> Inactivo</span></td>
                        
                            </template>
                        </tr>
                       
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirDetalles()">Salir</button>
              <button type="button" class="btn btn-primary" @click="editHorario(arrayDetalleHorario)">Editar</button>
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
            horarios:[],
            arrayDetalleHorario:[],
            id_horario:0,
            start:'',
            end:'',
            h1:'',
            h2:'',
            h1table:'',
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
          getHorarios(){
              let e = this;
              let url = '/horarios/index';
  
              axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
  
                e.horarios = respuesta;
  
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });
          },
          
          createHorario(){
            const e = this;
            e.table=0;
            e.start='';
            e.end='';
            e.estado=0;
            e.form=1;
            e.bandera=1;
          },
          validarInputs(){
            this.error = 0;
            this.arrayError = [];
            
            if(!this.start) this.arrayError.push('la hora inicial es necesario');
            if(!this.end) this.arrayError.push('la hora final es necesario');
            
            if(this.arrayError.length) this.error=1;
  
            return this.error;
            //console.log(this.arrayError)
  
          },
          
          storeHorario(){
            
            if(this.validarInputs()){
              return;
            }
             
            let e = this;  
            let url = '/horarios/store';

            var arrayHorario = {
              'start':this.start,
              'end':this.end,
            };

            axios.post(url, arrayHorario).then(function (response) {
              // handle success
              e.start = "";
              e.end = "";
              e.form=0;
              e.table=1;
              e.getHorarios();
  
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
            e.start = "";
            e.end = "";
            e.estado=0;
            e.arrayError=[];
          },
          DetallesHorario(data=[]){
            this.arrayDetalleHorario=data;
            //paso parametros en moment
            var h1 = moment(data['start'],'hh:mm:ss');
            var h2 = moment(data['end'],'hh:mm:ss');
            //asigno un formato
            this.start = h1.format('hh:mm a');
            this.end = h2.format('hh:mm a');
            this.estado = data['estado'];
             $("#detalles").modal('show');
          },
          salirDetalles(){
            const e = this;
            e.start= "";
            e.end = "";
            e.id_horario = 0;
            $("#detalles").modal('hide');
          },
          editHorario(data=[]){
            $("#detalles").modal('hide');
            this.table=0;
            this.form=1;
            this.bandera=2;
            this.id_horario = data['id_horario'];
            this.start = data['start'];
            this.end = data['end'];
          },
          updateHorario(){
            if(this.validarInputs()){
              return;
            }
  
            let e = this;  
            let url = '/horarios/update';
    
            var arrayHorario = {
              'start':this.start,
              'end':this.end,
              'id_horario':this.id_horario
            };
            axios.put(url, arrayHorario).then(function (response) {
              // handle success
              e.id_horario = 0;
              e.start = "";
              e.end = "";
              e.form=0;
              e.table=1;
              e.getHorarios();
  
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          },
          desactivar(id){
            let e = this;  
            let url = '/horarios/desactivar';
    
            var arrayHorario = {
              'id_horario':id
            };
            axios.put(url, arrayHorario).then(function (response) {
              // handle success
              e.getHorarios();
  
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          },
          activar(id){
            let e = this;  
            let url = '/horarios/activar';
    
            var arrayHorario = {
              'id_horario':id
            };
            axios.put(url, arrayHorario).then(function (response) {
              // handle success
              e.getHorarios();
  
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          }
          
      },
      mounted(){
        this.getHorarios();
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
  
  