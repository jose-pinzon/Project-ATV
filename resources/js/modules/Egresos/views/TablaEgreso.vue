<template>
    <section>
          <!-- Row -->
          <div >
            <!-- Datatables -->
            <div class="col-xl-12" >
                <div class=" mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <div class="col-md-2 col-md">
                        <div id="dataTable_length" class="dataTables_length">
                            <label for=""> Snow
                                <select name="dataTable_length" class="custom-select custom-select-sm form-control form-control-sm" id="" v-model="filasMostrar">
                                    <option value="2">2</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 form-group" id="simple-date2">
                        <label for="oneYearView">Inicio</label>
                        <div class="input-group date ">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" v-model="startDate"  >
                        </div>
                    </div>


                    <div class="col-md-3 form-group" id="simple-date3">
                        <label for="oneYearView">Fin</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>

                            <input v-show="startDate == ''" type="date" class="form-control" disabled>

                            <input v-show="startDate != ''"  type="date" class="form-control " v-model="finfecha" >
                        </div>
                    </div>

                    <div class="col-md-2 form-group" >
                        <label for="oneYearView">Generar PDF</label>
                        <div class="input-group date">
                            <a :href="generarPdf()" class="form-control btn btn-danger">PDF</a>
                        </div>
                        <!-- <pdf  class="form-control btn btn-danger" src="generar-pdf"></pdf> -->
                    </div>

                    <div class="input-group col-md-2">
                            <input type="text" v-model="search" class="form-control bg-light border-1 small" placeholder="¿Que desea buscar?"
                                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;" >
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            </div>
                    </div>
                </div>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable" v-if="Egresos">
                    <thead class="thead-light">
                      <tr>
                        <th>TIPO GASTO</th>
                        <th>DETALLE GASTO</th>
                        <th>CANTIDAD</th>
                        <th>MOTO</th>
                        <th>FECHA </th>
                        <th>ACCIONES</th>
                      </tr>
                    </thead>
                    <filas  @eliminar="eliminar($event)"  :datosEgresos="datosMostrar"></filas>

                    <tfoot>
                        <tr>
                        <th>TIPO GASTO</th>
                        <th>DETALLE GASTO</th>
                        <th>CANTIDAD</th>
                        <th>MOTO</th>
                        <th>FECHA </th>
                        <th>ACCIONES</th>
                      </tr>

                    </tfoot>
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
                <!-- TODO:parte paginacion -->
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
                <section class="contenido-gasto">
                    <div class="c-gasto">
                        <h2 class="h-gasto"> gasto total: </h2>
                        <input class="form-control" type="text" :value="total" disabled >
                    </div>
                    <div class="c-gasto">
                        <h2 class="h-gasto"> gasto por pagina: </h2>
                        <input class="form-control" type="text" :value="totalpage" disabled >
                    </div>

                </section>


                    <!-- TODO: icono de cargar -->



                </div>
                </div>
            </div>

            <!-- DataTable with Hover -->
        </section>
</template>

<script>
import { defineAsyncComponent } from 'vue'
import AtvApi from '../../../api/AtvApi'
import pdf from 'vue'
import axios from 'axios'

export default {
    components:{
        filas:defineAsyncComponent(()=> import('../components/filasEgreso.vue')),
        pdf
    },
    data(){
        return{
            total:0,
            totalpage:0,
            Egresos:null,
            EgresosTotales:null,
            pagination:{
                'total':0,
                'current_page':0,/* Pagina actual */
                'per_page':0,/* Por pagina */
                'last_page':0,/* Ultima pagina */
                'from':0,
                'to':0
            },
            offset:3,
            filasMostrar:null,
            search:'',
            paginationActive:0,
            startDate:'',
            finfecha:'',
            enrutador:0
        }
    },
    mounted(){
        this.obtenerDatos(this.pagination.current_page, this.filasMostrar)
        this.obtenerDatosEgreTotal()
    },

    methods:{

        eliminar(id){
            const params = {
                        id,
                        _method:'delete'
                    }

            const swalWithBootstrapButtons = this.$swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                        title: `¿Esta seguro de eliminar este registro? `,
                        text: "Una vez eliminado ya no se podra recuperar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Aceptar !',
                        cancelButtonText: 'Cancelar !',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.isConfirmed) {
                            AtvApi.post(`/egresoAtv/${ id }`, params).then(res =>{
                                this.obtenerDatos()
                                swalWithBootstrapButtons.fire(
                                'Deleted!',
                                res.data.message,
                                'success'
                                )
                            }).
                            catch(e => {
                                console.log(e);
                            })
                            }
                        })
        },


        async obtenerDatos(page, num_filas ){
            const { data } = await AtvApi.get(`/egresoAtv?page=${page}&num_filas=${num_filas}
            &inicio_fecha=${this.startDate}&fin_fecha=${this.finfecha}&enrutador=${this.enrutador}`)

            this.Egresos = data.egresos,
            this.pagination= data.pagination
            this.filasMostrar = data.pagina
            let total = 0
            this.Egresos.forEach(e => {
                total += parseFloat( e.cantidad)
            });

            this.totalpage = total
        },

        generarPdf(){
            return  `/api/generar-pdf?fecha1=${this.startDate}&fecha2=${this.finfecha}`
        },
        async obtenerDatosEgreTotal(){
            const { data } = await AtvApi.get(`/egresos`)
            this.EgresosTotales = data
            let total = 0

                data.forEach(e => {
                    total += parseFloat( e.cantidad)
                });
            this.total = total
        },


        cambiarpagina(page){
            this.pagination.current_page = page
            this.obtenerDatos(page, this.filasMostrar)
        },
    },
    watch:{

        finfecha(value,oldvalue){
            if(value == '' || this.startDate == null ) {
                this.enrutador = 0
                this.obtenerDatos(this.pagination.current_page, this.filasMostrar)
            }else{
                this.enrutador = 1
                this.obtenerDatos(this.pagination.current_page, this.filasMostrar)
            }
        },

        // startDate(newValue, oldValue){
        //     if(newValue = '')  this.obtenerDatos(this.pagination.current_page, this.filasMostrar)
        // },

        filasMostrar(value, oldvalue){
            switch (value) {
                case '2':
                    console.log('el valor es de 2');
                    this.obtenerDatos( this.pagination.current_page, value )
                break;
                case '5':
                    console.log('el valor es de 5');
                    this.obtenerDatos( this.pagination.current_page, value)
                break;

                case '10':
                    console.log('el valor es de 10');
                    this.obtenerDatos( this.pagination.current_page, value)
                break;

                case '15':
                    console.log('el valor es de 15');
                    this.obtenerDatos( this.pagination.current_page, value)
                break;
                default:
                    break;
            }
        },

    },
    computed:{

        //!Metodo de busqueda
        datosMostrar(){
            if (!this.search) {
                return this.Egresos
            }else{

                const datosfiltrados = this.EgresosTotales.filter( e =>  e.tipo_gasto.toLowerCase().includes( this.search.toLowerCase() ))
                return datosfiltrados
            }
        },

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
    .contenido-gasto{
        width: 80%;
        text-align: left;
        margin-left:50% ;
    }
    .c-gasto{
        display: block;
        float: left;
        margin:10px;
    }
    .h-gasto{
        margin-right: 10%;
        margin-top:2%;
        font-size: 20px;
    }

</style>
