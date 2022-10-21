<template>
    <section>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class=" mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                  <div class="col-sm-12 col-md">
                    <div id="dataTable_length" class="dataTables_length">
                        <label for=""> Snow
                            <select name="dataTable_length" class="custom-select custom-select-sm form-control form-control-sm" id="">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select>
                        </label>
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

                    <filas :datosEgresos="Egresos"></filas>
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
        </div>
            <!-- DataTable with Hover -->
        </section>
</template>

<script>
import { offset } from '@popperjs/core'
import { defineAsyncComponent } from 'vue'
    import AtvApi from '../../../api/AtvApi'

export default {
    components:{
        filas:defineAsyncComponent(()=> import('../components/filasEgreso.vue'))
    },
    data(){
        return{
            total:0,
            totalpage:0,
            Egresos:null,
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
        this.obtenerDatos()
        this.obtenerDatosEgreTotal()
    },
    methods:{
        async obtenerDatos(page){
            const { data } = await AtvApi.get(`/egresoAtv?page=${page}`)
            this.Egresos = data.egresos.data,
            this.pagination= data.pagination

            let total = 0
            this.Egresos.forEach(e => {
                total += parseFloat( e.cantidad)
            });

            this.totalpage = total
        },

        async obtenerDatosEgreTotal(){
            const { data } = await AtvApi.get(`/egresos`)

            let total = 0
            data.forEach(e => {
                total += parseFloat( e.cantidad)
            });

            this.total = total
        },

        cambiarpagina(page){
            this.pagination.current_page = page
            this.obtenerDatos(page)
        }
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
/*
    nav ul{
        width: 15%;
        border: 1px solid #ccc;
    }
    nav ul li{
        border: 1px solid #ccc;
        padding: 4px;
        text-decoration: none;
    } */
</style>
