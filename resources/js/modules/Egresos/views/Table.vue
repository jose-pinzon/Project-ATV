

<template>
    <div>
        <!--      Empieza Modal  Nuevo    -->
        <Modal>
            <template v-slot:Titulo>
                <h5 class="modal-title" id="exampleModalLabel"> Agregar nuevo dato </h5>

            <div v-show="mensaje" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><i class="fas fa-ban"></i><b> Guardado</b></h6>
                {{mensaje}}
            </div>

            </template>
            <template v-slot:contenido>
                <form @submit.prevent="guardarATV">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero Atv</label>
                        <input type="number" class="form-control" :class="{ 'is-invalid' : Errores.numero_Atv}" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.numero_Atv">

                        <small v-show="!DatosGuardar.numero_Atv"  class="font-weight-bold text-warning    form-text ">
                            numero obligatorio
                        </small>
                        <small v-if="Errores.numero_Atv"  class="font-weight-bold text-warning    form-text ">
                            {{Errores.numero_Atv[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Velocidad Maxima</label>
                        <input type="number" class="form-control"  :class="{ 'is-invalid' : Errores.max_velocidad}"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.max_velocidad">
                        <small v-show="!DatosGuardar.max_velocidad"  class="font-weight-bold text-warning  form-text ">
                            La velocidad es obligatorio
                        </small>
                        <small v-if=" Errores.max_velocidad"  class="font-weight-bold text-warning  form-text ">
                            {{Errores.max_velocidad[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Placa</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid' : Errores.placa}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.placa">

                        <small v-show="!DatosGuardar.placa "  class="font-weight-bold text-warning   form-text ">
                            La placa es obligatoria
                        </small>

                        <small v-if="Errores.placa"  class="font-weight-bold text-warning   form-text ">
                            {{Errores.placa[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero serie</label>
                        <input type="text" class="form-control"  :class="{ 'is-invalid' : Errores.num_serie}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.num_serie">
                        <small v-show="!DatosGuardar.num_serie "  class="font-weight-bold text-warning    form-text ">
                            Numero serie es obligatorio
                        </small>

                        <small v-if=" Errores.num_serie"  class="font-weight-bold text-warning    form-text ">
                            {{Errores.num_serie[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero motor</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid' : Errores.num_motor}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.num_motor">
                        <small v-show="!DatosGuardar.num_motor "  class="font-weight-bold text-warning    form-text ">
                            Numero motor obligatorio
                        </small>
                        <small v-if=" Errores.num_motor"  class="font-weight-bold text-warning    form-text ">
                            {{Errores.num_motor[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Propietario</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid' : Errores.propietario}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.propietario">
                        <small v-show="!DatosGuardar.propietario"  class="font-weight-bold text-warning   form-text ">
                            Propietario obligatorio
                        </small>
                        <small v-if="Errores.propietario"  class="font-weight-bold text-warning   form-text ">
                            {{Errores.propietario[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Marca </label>
                        <input type="text" class="form-control"  :class="{ 'is-invalid' : Errores.marca}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.marca">
                        <small v-show="!DatosGuardar.marca "  class="font-weight-bold text-warning  form-text ">
                            marca obligatorio
                        </small>

                        <small v-if=" Errores.marca"  class="font-weight-bold text-warning  form-text ">
                            {{Errores.marca[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Modelo </label>
                        <input type="text" class="form-control" :class="{ 'is-invalid' : Errores.modelo}" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.modelo">
                        <small v-show="!DatosGuardar.modelo "  class="font-weight-bold text-warning   form-text ">
                            modelo obligatorio
                        </small>
                        <small v-if="Errores.modelo"  class="font-weight-bold text-warning   form-text ">
                            {{Errores.modelo[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Color </label>
                        <input type="text" class="form-control" :class="{ 'is-invalid' : Errores.color}" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="DatosGuardar.color">



                        <small v-show="!DatosGuardar.color " class="font-weight-bold text-warning   form-text ">
                            Color obligatorio
                        </small>

                        <small v-if="Errores.color" class="font-weight-bold text-warning   form-text ">
                            {{Errores.color[0]}}
                        </small>
                    </div>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </template>

        </Modal>
        <!-- Termina Modal -->















    <!--Modal para poder editar -->
    <ModalD  v-if="detallesMoto">
        <template v-slot:Titulo>
            <h5 class="modal-title">  Editar </h5>

            <div v-show="mensajeError" class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><i class="fas fa-ban"></i><b> Stop!</b></h6>
                {{mensajeError}}
            </div>

            <div v-show="mensaje" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><i class="fas fa-ban"></i><b> Actualizado</b></h6>
                {{mensaje}}
            </div>

        </template>
        <template v-slot:contenido>


            <form @submit.prevent="EditarAtv(detallesMoto.id)">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero Atv</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.numero_Atv">
                        <small v-show="!detallesMoto.numero_Atv"  class="font-weight-bold text-warning    form-text ">
                            nombre obligatorio
                        </small>
                        <small v-if="Errores.numero_Atv" class="font-weight-bold text-warning   form-text ">
                            {{Errores.numero_Atv[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Velocidad Maxima</label>
                        <input type="number" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.max_velocidad">
                        <small v-show="!detallesMoto.max_velocidad"  class="font-weight-bold text-warning  form-text ">
                            La velocidad es obligatorio
                        </small>
                        <small v-if="Errores.max_velocidad" class="font-weight-bold text-warning   form-text ">
                            {{Errores.max_velocidad[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Placa</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.placa">
                        <small v-show="!detallesMoto.placa"  class="font-weight-bold text-warning   form-text ">
                            placa obligatorio
                        </small>
                        <small v-if="Errores.placa" class="font-weight-bold text-warning   form-text ">
                            {{Errores.placa[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero serie</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.num_serie">
                        <small v-show="!detallesMoto.num_serie"  class="font-weight-bold text-warning    form-text ">
                            Numero serie es obligatorio
                        </small>
                        <small v-if="Errores.num_serie" class="font-weight-bold text-warning   form-text ">
                            {{Errores.num_serie[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero motor</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.num_motor">
                        <small v-show="!detallesMoto.num_motor"  class="font-weight-bold text-warning    form-text ">
                            Numero motor obligatorio
                        </small>
                        <small v-if="Errores.num_motor" class="font-weight-bold text-warning   form-text ">
                            {{Errores.num_motor[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Propietario</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.propietario">
                        <small v-show="!detallesMoto.propietario"  class="font-weight-bold text-warning   form-text ">
                            Propietario obligatorio
                        </small>
                        <small v-if="Errores.propietario" class="font-weight-bold text-warning   form-text ">
                            {{Errores.propietario[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Marca </label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.marca">
                        <small v-show="!detallesMoto.marca"  class="font-weight-bold text-warning  form-text ">
                            marca obligatorio
                        </small>
                        <small v-if="Errores.marca" class="font-weight-bold text-warning   form-text ">
                            {{Errores.marca[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Modelo </label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.modelo">
                        <small v-show="!detallesMoto.modelo"  class="font-weight-bold text-warning   form-text ">
                            modelo obligatorio
                        </small>
                        <small v-if="Errores.modelo" class="font-weight-bold text-warning   form-text ">
                            {{Errores.modelo[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Color </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="detallesMoto.color">
                        <small v-show="!detallesMoto.color" class="font-weight-bold text-warning   form-text ">
                            Color obligatorio
                        </small>
                        <small v-if="Errores.color" class="font-weight-bold text-warning   form-text ">
                            {{Errores.color[0]}}
                        </small>
                    </div>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>
        </template>
    </ModalD>
    <!-- Fin del modal para editar -->
        <section>
        <button  class="btn btn-primary btn-add" data-toggle="modal" data-target="#exampleModal"
                        id="#myBtn">
                        Agregar
        </button>


        <table v-if="datosFilas" class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th hidden > </th>
                    <th>No.ATV</th>
                    <th>PLACA</th>
                    <th>No.SERIE</th>
                    <th>PROPIETARIO</th>
                    <th>ESTADO</th>
                    <th>ACCION</th>

                </tr>
            </thead>
        <Fila :datosP="datosFilas" @buttonEliminar="EliminarAtv($event)" @buttonEditar="mostrarMensaje($event)"></Fila>
        </table>

        <div v-else
            class="row justify-content-md-center  loading">
            <div class="col-3 alert-info text-center mt-5">
                Espere por favor...
                <h3 class="mt-2">
                    <i class="fa fa-spin fa-sync"></i>
                </h3>
            </div>
        </div>
        <nav aria-label="...">
                <ul class="pagination">
                    <li  class="page-item" v-if="pagination.current_page > 1">
                            <a  class="page-link " href="#"  @click.prevent="cambiarpagina(pagination.current_page - 1)">
                                    <span>Atras</span>
                            </a>
                    </li>

                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[ page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarpagina(page)">
                                {{page}}
                            </a>
                    </li>

                    <li  class="page-item" v-if="pagination.current_page <  pagination.last_page">
                        <a  class="page-link" href="#" @click.prevent="cambiarpagina(pagination.current_page + 1)">
                            <span>
                                Siguiente
                            </span>
                        </a>
                    </li>

                </ul>
            </nav>

    </section>

    <section  v-if="detallesMoto"  class="contenido_detalles" >
        <Detalles :datos="detallesMoto"></Detalles>
        <button  class="boton_personal" @click="Regresar">No mostrar</button>
        <button  class="boton_personal btn-edit" data-toggle="modal" data-target="#exampleModalScrollable"
                        id="#myBtn2">
                    editar
        </button>

        <div class="fix"> </div>
    </section>

    </div>
</template>




<script>
    import { defineAsyncComponent } from 'vue'
    import AtvApi from '../../../api/AtvApi'
    export default {
        components:{
            Fila: defineAsyncComponent(() => import('../components/filas.vue')),
            Modal: defineAsyncComponent(() => import('../components/modal.vue')),
            ModalD: defineAsyncComponent(() => import('../components/modalDetalle.vue')),
            Detalles: defineAsyncComponent(() => import('../components/MostrarDetalles.vue'))
        },

        data(){
            return{
                detallesMoto:null,
                datosFilas:null,
                DatosGuardar:{
                    numero_Atv:0,
                    max_velocidad:0,
                    placa:'',
                    num_serie:'',
                    num_motor:'',
                    propietario:'',
                    marca:'',
                    modelo:'',
                    color:'',
                },
                mensaje:null,
                mensajeError:null,
                Errores:{},
                pagination:{
                    'total':0,
                    'current_page':0,/* Pagina actual */
                    'per_page':0,/* Por pagina */
                    'last_page':0,/* Ultima pagina */
                    'from':0,
                    'to':0
                },
                offset:3
            }
        },

        mounted(){
            this.getAtv()
        },

        methods:{

            Regresar(){
                this.detallesMoto = null
            },
            mostrarMensaje( id ){
                this.detallesMoto = id
            },

            async getAtv( page ){
                const { data } = await AtvApi.get(`/motoAtv?page=${page}`)
                    this.datosFilas = data.motos.data
                    this.pagination = data.pagination
            },

            async guardarATV(){

                try {
                    const { data } = await AtvApi.post('/motoAtv', this.DatosGuardar)
                    this.getAtv()

                    this.DatosGuardar.numero_Atv = 0
                    this.DatosGuardar.max_velocidad = 0
                    this.DatosGuardar.placa = ''
                    this.DatosGuardar.num_serie = ''
                    this.DatosGuardar.num_motor = ''
                    this.DatosGuardar.propietario = ''
                    this.DatosGuardar.marca = ''
                    this.DatosGuardar.modelo = ''
                    this.DatosGuardar.color = ''

                    return alert(` ${ data.message } `)
                } catch (error){
                    if( error.response.status === 422){
                        this.Errores = error.response.data.errors
                    }
                }

            },

            async EditarAtv(id){
                try {
                    const { data } = await AtvApi.put(`/motoAtv/${ id }`, this.detallesMoto)
                    this.mensaje = data.message
                    this.getAtv()
                } catch (error) {
                    if( error.response.status === 422){
                        this.Errores = error.response.data.errors
                    }

                    if ( error.response.status === 500 ) {
                        this.mensajeError = 'No se puede guardar por que el numero de la Atv ya existe'
                    }
                }

            },


            async EliminarAtv(id){
                    const params = {
                        id,
                        _method:'delete'
                    }

                try{
                    const confirmar = confirm('¿Esta seguro de eliminar este registro?')
                    if(!confirmar) return
                    const { data } = await AtvApi.post(`/motoAtv/${ id }`, params)
                    this.getAtv()
                    alert(data.message)
                }catch(e){
                        this.Errores = error.response.data
                }
            },


            cambiarpagina(page){
                this.pagination.current_page = page
                this.getAtv(page)
            },


        },
        computed:{
            isActived(){
                return this.pagination.current_page
            },
            pagesNumber(){
                if (!this.pagination.to) {
                    return []
                }

                let from = this.pagination.current_page - this.offset /* ! offset para colocar cuantas pagina alante o atras podemos saltar */
                if(from < 1 ){
                    from = 1
                }

                let to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page
                }


                let pagesA = []
                while(from <= to){
                    pagesA.push(from)
                    from++
                }

                return pagesA;
            }
        }
    }
    </script>



<style scoped>

    nav{
       margin-left: 20px;
    }
    .loading{
        margin-bottom:10%;
    }

    .btn-add{
        margin-left:20px;
        margin-bottom:20px;
    }
    .contenido_detalles{
        box-shadow: 1px 1px 8px black;
        border: 1px solid #ccc;
        background-color: #ffff;
        position: fixed;

        left:10%;
        top: 15%;
        bottom: 5%;
        padding:1em;
        width:50%;
        z-index: 1;
    }



.boton_personal {
    background-color: transparent;
    font-weight: bold;
    color: #444;
    font-size: 1rem;
    padding: 1rem 1.5rem;
    border: 2px solid #eee;
    border-radius:.5rem;
    cursor: pointer;
    transition: all 1s ease;
    box-shadow:  .5rem .5rem 1rem #ccc,
    -.5rem -.5rem 1rem #fff ;
    float: left;
}

.btn-edit{
    margin-left: 5px;
    background-color:yellow;
}

/* .fix{
    float: none;
    clear:both;
} */

.boton_personal:hover{
    box-shadow:  .2rem .2rem 1rem #fff,
    -.5rem -.5rem 1rem #ccc    ;
}

.boton_personal:active{
    box-shadow: inset .2rem .2rem 1rem #fff,
    inset -.2rem -.2rem 1rem #ccc    ;
}


</style>
