<template>
  <div class="col-lg-12">
    <div class="card">
      <div v-if="table">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Clientes frecuentes</h6>
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
                      @keyup.enter="getclientes(1, criterio, buscar)">
                      <button type="button" @click="getclientes(1, criterio, buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                      <button class="btn btn-info" @click="createCliente()">Nuevo</button>
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cliente in clientes" :key="cliente.id_cliente">
                <td><a href="#" @click="editCliente(cliente)">{{cliente.id_cliente}}</a></td>
                <td>{{cliente.nombres}}</td>
                <td>{{cliente.apellidos}}</td>
                <td><span class="badge badge-success">{{cliente.telefono}}</span></td>
                <td>
                    <button type="button" @click="DetallesCliente(cliente)" class="btn btn-sm btn-primary">Detales</button>
                    <button type="button" @click="editCliente(cliente)" class="btn btn-sm btn-warning">Editar</button>
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
            <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==1">Nuevo cliente</h6>
            <h6 class="m-0 font-weight-bold text-primary" v-if="bandera==2">Editar cliente</h6>
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
              <button class="btn btn-danger" @click="cancelar()">Cancelar</button>

              <button class="btn btn-primary" @click="storeCliente()" v-if="bandera==1">Registrar</button>
              <button class="btn btn-primary"  v-if="bandera==2" @click="updateCliente()">Actualizar</button>

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
            <h5 class="modal-title" id="exampleModalLabel">Detalles del cliente</h5>
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
                        <th>Telefono: {{telefono}}</th>
                      </tr>
                      <tr>
                        <th>Email: {{email}}</th>
                      </tr>
                      <tr>
                        <th>Nacionalidad: {{nacionalidad}}</th>
                      </tr>
                      <tr>
                        <th>Pais: {{pais}}</th>
                      </tr>
                      <tr>
                        <th>Ciudad: {{ciudad}}</th>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirDetalles()">Salir</button>
            <button type="button" class="btn btn-primary" @click="editCliente(arrayDetalleCliente)">Editar</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
    data(){
        return{
          clientes:[],
          arrayDetalleCliente:[],
          id_cliente:0,
          nombres:'',
          apellidos:'',
          telefono:'',
          email:'',
          nacionalidad:'',
          pais:'',
          ciudad:'',
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
        getclientes(page, criterio, buscar){
            let e = this;
            let url = '/clients?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;

            axios.get(url).then(function (response) {
              // handle success
              var respuesta = response.data;

              e.clientes = respuesta.clientes.data;

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
              me.getclientes(page, criterio, buscar);
        },
        createCliente(){
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
          
          if(this.arrayError.length) this.error=1;

          return this.error;
          //console.log(this.arrayError)

        },
        storeCliente(){
          if(this.validarInputs()){
            return;
          }

          let e = this;  
          let url = '/clients/store';
          var arrayCliente = {
            'nombres':this.nombres,
            'apellidos':this.apellidos,
            'telefono':this.telefono,
            'email':this.email,
            'nacionalidad':this.nacionalidad,
            'pais':this.pais,
            'ciudad':this.ciudad
          };
          axios.post(url, arrayCliente).then(function (response) {
            // handle success
            e.nombres = "";
            e.apellidos = "";
            e.telefono = "";
            e.email = "";
            e.nacionalidad = "";
            e.pais = "";
            e.ciudad = "";
            e.form=0;
            e.table=1;
            e.getclientes(1,e.criterio,'');

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
          e.nacionalidad = "";
          e.pais = "";
          e.ciudad = "";
          e.arrayError=[];
        },
        DetallesCliente(data=[]){
          this.arrayDetalleCliente=data;
          this.nombres = data['nombres'];
          this.apellidos = data['apellidos'];
          this.telefono = data['telefono'];
          this.email = data['email'];
          this.nacionalidad = data['nacionalidad'];
          this.pais = data['pais'];
          this.ciudad = data['ciudad'];
           $("#detalles").modal('show');
        },
        salirDetalles(){
          const e = this;
          e.nombres = "";
          e.apellidos = "";
          e.telefono = "";
          e.email = "";
          e.nacionalidad = "";
          e.pais = "";
          e.ciudad = "";
          $("#detalles").modal('hide');
        },
        editCliente(data=[]){
          $("#detalles").modal('hide');
          this.table=0;
          this.form=1;
          this.bandera=2;
          this.id_cliente = data['id_cliente'];
          this.nombres = data['nombres'];
          this.apellidos = data['apellidos'];
          this.telefono = data['telefono'];
          this.email = data['email'];
          this.nacionalidad = data['nacionalidad'];
          this.pais = data['pais'];
          this.ciudad = data['ciudad'];

        },
        updateCliente(){
          if(this.validarInputs()){
            return;
          }

          let e = this;  
          let url = '/clients/update';
          var arrayCliente = {
            'nombres':this.nombres,
            'apellidos':this.apellidos,
            'telefono':this.telefono,
            'email':this.email,
            'nacionalidad':this.nacionalidad,
            'pais':this.pais,
            'ciudad':this.ciudad,
            'id_cliente':this.id_cliente
          };
          axios.put(url, arrayCliente).then(function (response) {
            // handle success
            e.id_cliente = 0;
            e.nombres = "";
            e.apellidos = "";
            e.telefono = "";
            e.email = "";
            e.nacionalidad = "";
            e.pais = "";
            e.ciudad = "";
            e.form=0;
            e.table=1;
            e.getclientes(1,e.criterio,'');

          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        }
        
    },
    mounted(){
      this.getclientes(1,this.criterio,this.buscar);
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
</style>

