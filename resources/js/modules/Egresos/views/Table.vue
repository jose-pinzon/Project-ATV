

<template>
    <div>

        <!--      Empieza Modal        -->
        <Modal>
            <template v-slot:Titulo>
                <h5 class="modal-title" id="exampleModalLabel"> Agregar nuevo dato </h5>
            </template>
            <template v-slot:contenido>
                <form @submit.prevent="guardarATV">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero Atv</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="numero_Atv">
                        <small v-show="!numero_Atv"  class="font-weight-bold text-warning    form-text ">
                            nombre obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Velocidad Maxima</label>
                        <input type="number" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="max_velocidad">
                        <small v-show="!max_velocidad"  class="font-weight-bold text-warning  form-text ">
                            La velocidad es obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Placa</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="placa">
                        <small v-show="!placa"  class="font-weight-bold text-warning   form-text ">
                            placa obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero serie</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="num_serie">
                        <small v-show="!num_serie"  class="font-weight-bold text-warning    form-text ">
                            Numero serie es obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero motor</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="num_motor">
                        <small v-show="!num_motor"  class="font-weight-bold text-warning    form-text ">
                            Numero motor obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Propietario</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="propietario">
                        <small v-show="!propietario"  class="font-weight-bold text-warning   form-text ">
                            Propietario obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Marca </label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="marca">
                        <small v-show="!marca"  class="font-weight-bold text-warning  form-text ">
                            marca obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Modelo </label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="modelo">
                        <small v-show="!modelo"  class="font-weight-bold text-warning   form-text ">
                            modelo obligatorio
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Color </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="escriba aqui..." v-model="color">
                        <small v-show="!color" class="font-weight-bold text-warning   form-text ">
                            Color obligatorio
                        </small>
                    </div>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </template>

        </Modal>
        <!-- Termina Modal -->
        <section>
        <button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
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
                    <th>ACCION</th>

                </tr>
            </thead>
            <Fila :datosP="datosFilas" @buttonEditar="mostrarMensaje($event)"></Fila>
        </table>
        <div v-else>
            <h1>Cargando ...</h1>
        </div>
    </section>

    <section  v-if="detallesMoto"  class="contenido_detalles" >
        <Editar :datos="detallesMoto"></Editar>
        <button  class="boton_personal" @click="Regresar">No mostrar</button>
        <ModalD></ModalD>

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
            Editar: defineAsyncComponent(() => import('../components/Editar.vue'))
        },
        data(){
            return{
                detallesMoto:null,
                datosFilas:null,
                    numero_Atv:0,
                    max_velocidad:0,
                    placa:'',
                    num_serie:'',
                    num_motor:'',
                    propietario:'',
                    marca:'',
                    modelo:'',
                    color:'',
                    myModal:null

            }
        },

        mounted(){
            this.getAtv()
        },

        methods:{
            showModal(){
                this.myModal = new bootstrap.Modal(document.getElementById('add_userModal'), {})
                this.myModal.show()
            },

            Regresar(){
                this.detallesMoto = null
            },
            mostrarMensaje( id ){
                this.detallesMoto = id
            },

            async getAtv(){
                const { data } = await AtvApi.get('/motoAtv')
                this.datosFilas = data
            },

            async guardarATV(){

                const datos  = {
                    numero_Atv: parseInt( this.numero_Atv ) ,
                    max_velocidad: parseInt( this.max_velocidad) ,
                    placa: this. placa,
                    num_serie: this.num_serie,
                    num_motor: this.num_motor,
                    propietario: this.propietario,
                    marca: this.marca,
                    modelo: this.modelo,
                    color :this.color
                }

                try {
                    const { data } = await AtvApi.post('/motoAtv', datos)
                    this.getAtv()

                    this.numero_Atv = 0
                    this.max_velocidad = 0
                    this.placa = ''
                    this.num_serie = ''
                    this.num_motor = ''
                    this.propietario = ''
                    this.marca = ''
                    this.modelo = ''
                    this.color = ''

                    $("#exampleModal").modal('hide');
                    return alert(` ${ data.message } `)
                } catch (error) {
                    throw `El error ${error}`
                }


            }

        },
    }
    </script>



<style scoped>
    .contenido_detalles{
        box-shadow: 1px 1px 8px black;
        border: 1px solid #ccc;
        background-color: #ffff;
        position: fixed;
        margin:0 auto;
        left:10%;
        bottom: 40%;
        padding:3em;
        width:50%;
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
.fix{
    float: none;
    clear:both;
}

.boton_personal:hover{
    box-shadow:  .2rem .2rem 1rem #fff,
    -.5rem -.5rem 1rem #ccc    ;
}

.boton_personal:active{
    box-shadow: inset .2rem .2rem 1rem #fff,
    inset -.2rem -.2rem 1rem #ccc    ;
}


</style>
