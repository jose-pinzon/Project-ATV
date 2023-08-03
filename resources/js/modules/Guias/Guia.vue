<template>
    <div class="col-lg-12">
      <div class="card">
        <div v-if="table">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Guias</h6>
          </div>
          <div class="table-responsive">

            <div class="form-group row" id="navegador">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" v-model="criterio">
                          <option value="nombres">Nombre</option>
                          <option value="apellidos">Apellido</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Texto a buscar" v-model="buscar"
                        @keyup.enter="getGuia(1, criterio, buscar)">
                        <button type="button" @click="getGuia(1, criterio, buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        <button class="btn btn-info" @click="createGuia()">Nuevo</button>
                    </div>
                </div>
            </div>

            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>ID</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Telefono</th>
                  <th>Estado</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="guia in guias" :key="guia.id_guia">
                  <td><a href="#" @click="editGuia(guia)">{{guia.id_guia}}</a></td>
                  <td>{{guia.nombres}}</td>
                  <td>{{guia.apellidos}}</td>
                  <td><span class="badge badge-success">{{guia.telefono}}</span></td>
                  <template v-if="guia.estado">

                        <td class="estado" @click="desactivar(guia.id_guia)"><span class="badge badge-success">Activo</span></td>

                  </template>
                  <template v-else>

                        <td class="estado" @click="activar(guia.id_guia)"><span class="badge badge-danger">Inactivo</span></td>

                  </template>

                  <td>
                      <button type="button" @click="DetallesGuia(guia)" class="btn btn-sm btn-primary">Detales</button>
                      <button type="button" @click="editGuia(guia)" class="btn btn-sm btn-warning">Editar</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <nav id="navegador">
                <!-- aplicar paginacion -->
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, criterio, buscar)">Ant</a>
                    </li>

                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,criterio, buscar)" v-text="page"></a>
                    </li>

                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, criterio, buscar)">Sig</a>
                    </li>
                </ul>
            </nav>
          </div>
      </div>

      <div  v-if="form==1">

          <div class="card mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==1">Nuevo guia</h6>
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==2">Editar guia</h6>
            </div>
              <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error">{{error}}</p></center>
            <div class="card-body">

                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Nombres</label>
                    <input type="text" class="form-control" placeholder="Nombres" v-model="nombres">

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
                    <label for="exampleInputPassword1">Edad</label>
                    <input type="number" class="form-control" placeholder="Edad" v-model="edad">
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Igles</label>
                       <select name="" id="" class="form-control" v-model="ingles">
                        <option value="" disabled>Elige una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                       </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Dirección</label>
                    <input type="text" class="form-control" placeholder="Domicilio" v-model="direccion">
                  </div>

                </div>


                <hr>
                <button class="btn btn-danger" @click="cancelar()">Cancelar</button>

                <button class="btn btn-primary" @click="storeGuia()" v-if="bandera==1">Registrar</button>
                <button class="btn btn-primary"  v-if="bandera==2" @click="updateGuia()">Actualizar</button>

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
              <h5 class="modal-title" id="exampleModalLabel">Detalles del guia</h5>
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
                          <th>Nombre: {{nombres}}</th>
                        </tr>
                        <tr>
                          <th>Apellidos: {{apellidos}}</th>
                        </tr>
                        <tr>
                          <th>Edad: {{email}}</th>
                        </tr>
                        <tr>
                          <th>Telefono: {{telefono}}</th>
                        </tr>
                        <tr>
                          <th>Email: {{email}}</th>
                        </tr>
                        <tr>
                          <th>Dirección: {{direccion}} </th>
                        </tr>
                        <tr>
                          <th>Ingles: {{ingles}} </th>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirDetalles()">Salir</button>
              <button type="button" class="btn btn-primary" @click="editGuia(arrayDetalleGuia)">Editar</button>
            </div>
          </div>
        </div>
      </div>

      aRRAY: {{ datos }}

    </div>
  </template>

  <script>
  export default {
        props:{
            datos:{
                typeof:Array,
                require:true
            }
        },

      data(){
          return{
            guias:[],
            arrayDetalleGuia:[],
            id_guia:0,
            nombres:'',
            apellidos:'',
            telefono:'',
            edad:18,
            email:'',
            direccion:'',
            ingles:'',
            estado:1,
            //VARIABLES PAGINACION
            pagination : {
                  'total' :0,
                  'current_page' : 0,
                  'per_page' : 0,
                  'last_page' : 0,
                  'from' : 0,
                  'to' : 0
              },
              offset:3,
              //variables busqueda
              criterio:'nombres',
              buscar:'',
              //varaibles interfaz
              table:1,
              form:0,
              bandera:1,
              //variables de validacion
              errortext:'',
              error:0,
              arrayError:[]
          }
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

      },
      methods:{
          getGuia(page, criterio, buscar){
              let e = this;
              let url = '/guias/index?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;

              axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;

                e.guias = respuesta.guias.data;

                e.pagination = respuesta.pagination;
                //console.log(response.data);
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });
          },
           //metodo paginaion
          cambiarPagina(page, criterio, buscar){
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page = page;

                //envia la peticion para visualizar la data en la vista
                //el page lo recibe el metodo de lista cat
                me.getGuia(page, criterio, buscar);
          },
          createGuia(){
            const e = this;
            e.table=0;
            e.form=1;
            e.bandera=1;
          },
          validarInputs(){
            this.error = 0;
            this.arrayError = [];

            if(!this.nombres) this.arrayError.push('los nombres son requeridos');
            if(!this.apellidos) this.arrayError.push('los apellidos son requeridos');
            if(!this.telefono) this.arrayError.push('El telefono es requeridos');
            if(!this.edad) this.arrayError.push('La edad es requerido');
            if(this.edad < 18) this.arrayError.push('Tiene que ser mayor de 18');

            if(this.arrayError.length) this.error=1;

            return this.error;
            //console.log(this.arrayError)

          },

          storeGuia(){

            if(this.validarInputs()){
              return;
            }

            let e = this;
            let url = '/guias/store';
            var arrayGuia = {
              'nombres':this.nombres,
              'apellidos':this.apellidos,
              'telefono':this.telefono,
              'email':this.email,
              'edad':this.edad,
              'direccion':this.direccion,
              'ingles':this.ingles
            };
            axios.post(url, arrayGuia).then(function (response) {
              // handle success
              e.nombres = "";
              e.apellidos = "";
              e.telefono = "";
              e.email = "";
              e.edad = "";
              e.ingles = "";
              e.direccion = "";
              e.form=0;
              e.table=1;
              e.getGuia(1,e.criterio,'');

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
            e.nombres = "";
            e.apellidos = "";
            e.telefono = "";
            e.email = "";
            e.edad = "";
            e.direccion = "";
            e.ingles = "";
            e.arrayError=[];
          },
          DetallesGuia(data=[]){
            this.arrayDetalleGuia=data;
            this.nombres = data['nombres'];
            this.apellidos = data['apellidos'];
            this.telefono = data['telefono'];
            this.email = data['email'];
            this.edad = data['edad'];
            this.direccion = data['direccion'];
            this.ingles = data['ingles'];
             $("#detalles").modal('show');
          },
          salirDetalles(){
            const e = this;
            e.nombres = "";
            e.apellidos = "";
            e.telefono = "";
            e.email = "";
            e.edad = "";
            e.ingles = "";
            e.direccion = "";
            $("#detalles").modal('hide');
          },
          editGuia(data=[]){
            $("#detalles").modal('hide');
            this.table=0;
            this.form=1;
            this.bandera=2;
            this.id_guia = data['id_guia'];
            this.nombres = data['nombres'];
            this.apellidos = data['apellidos'];
            this.telefono = data['telefono'];
            this.email = data['email'];
            this.direccion = data['direccion'];
            this.edad = data['edad'];
            this.ingles = data['ingles'];

          },
          updateGuia(){
            if(this.validarInputs()){
              return;
            }

            let e = this;
            let url = '/guias/update';

            var arrayGuia = {
              'nombres':this.nombres,
              'apellidos':this.apellidos,
              'telefono':this.telefono,
              'email':this.email,
              'edad':this.edad,
              'direccion':this.direccion,
              'ingles':this.ingles,
              'id_guia':this.id_guia
            };
            axios.put(url, arrayGuia).then(function (response) {
              // handle success
              e.id_guia = 0;
              e.nombres = "";
              e.apellidos = "";
              e.telefono = "";
              e.email = "";
              e.edad = "";
              e.direccion = "";
              e.ingles = "";
              e.form=0;
              e.table=1;
              e.getGuia(1,e.criterio,'');

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          },
          desactivar(id){
            let e = this;
            let url = '/guias/desactivar';

            var arrayGuia = {
              'id_guia':id
            };
            axios.put(url, arrayGuia).then(function (response) {
              // handle success
              e.getGuia(1,e.criterio,'');

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          },
          activar(id){
            let e = this;
            let url = '/guias/activar';

            var arrayGuia = {
              'id_guia':id
            };
            axios.put(url, arrayGuia).then(function (response) {
              // handle success
              e.getGuia(1,e.criterio,'');

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
          }

      },
      mounted(){
        this.getGuia(1,this.criterio,this.buscar);
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

