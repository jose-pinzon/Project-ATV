
<template>
    <section class="contenedor">
        <!-- <div class="row">
                    <card @MostrarIngEgre="cargarDatosMoto($event)"  v-for="moto in DatosMotosEgresos.MotosAll"  :key="moto.id" :moto="moto">
                    </card>
        </div> -->
        <section v-if="DatosMotosEgresos">
            <div class="row contenidoColor">
                <h1 class="bg-gradient-warning"> Motos amarillas</h1>
                        <card @MostrarIngEgre="cargarDatosMoto($event)"  v-for="moto in DatosMotosEgresos.MotosAmarillas"  :key="moto.id" :moto="moto">
                        </card>
            </div>

            <div class="row contenidoColor">
                <h1 class="bg-gradient-danger"> Motos Rojas</h1>

                        <card @MostrarIngEgre="cargarDatosMoto($event)"  v-for="moto in DatosMotosEgresos.MotosRojas"  :key="moto.id" :moto="moto">
                        </card>
            </div>

            <div class="row contenidoColor">
                <h1 class="bg-gradient-success"> Motos Verde</h1>

                        <card @MostrarIngEgre="cargarDatosMoto($event)"  v-for="moto in DatosMotosEgresos.MotosVerdes"  :key="moto.id" :moto="moto">
                        </card>
            </div>
        </section>


        <div v-else class="row justify-content-md-center  loading">
            <div class="col-3 alert-white text-center mt-5">
                Espere por favor...
                <h3 class="mt-8">
                    <i class="fa fa-spin fa-sync"></i>
                </h3>
            </div>
            <!-- <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            </div>
            <span class="visually-hidden">Loading...</span> -->
        </div>


        <Modal  v-if="modalstatus" @on:close="modalstatus=false">
            <template v-slot:header>

            </template>
            <template v-slot:body>
                    <!-- Row -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables</h6> -->
                </div>
                <div class="table-responsive p-3">
                    <h2>Numero de Atv: {{CuentasAtv.numero_Atv}}</h2>
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>TIPO GASTO</th>
                                <th>GASTO</th>
                                <th>CANTIDAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cuenta in CuentasAtv.egresos" :key="cuenta.id">
                                <td>{{cuenta.tipo_gasto}}</td>
                                <td>{{cuenta.gasto}}</td>
                                <td>{{cuenta.cantidad}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </template>
            <template v-slot:footer>

                <div  class="form-group contentenido-cuentas">
                    <label for="exampleFormControlReadonly">Egreso</label>
                    <input class="form-control" type="text" :value="totalgasto"
                        id="exampleFormControlReadonly" readonly>
                </div>

                <div  class="form-group contentenido-cuentas">
                    <label for="exampleFormControlReadonly">Ganancia</label>
                    <input class="form-control" type="text" :value="totalGanancias"
                        id="exampleFormControlReadonly" readonly>
                </div>


                <button class="btn btn-primary" @click="modalstatus=false">Cerrar</button>
            </template>

        </Modal>


    </section>
</template>

<script>
import { defineAsyncComponent } from 'vue'
import AtvApi from '../../../api/AtvApi'
export default {
    name:'egresos-porMotos',
    components:{
        card:defineAsyncComponent(()=> import('../components/cardMoto.vue')),
        Modal:defineAsyncComponent(()=> import('../components/ModalPersonalizado.vue'))
    },
    mounted(){
        this.GetMotos()
    },
    data(){
        return{
            DatosMotosEgresos:null,
            CuentasAtv:null,
            modalstatus:false,
            TotalEgreso:0
        }
    },

    methods:{
        async GetMotos(){
            const { data }  = await AtvApi.get('/motos')
                this.DatosMotosEgresos = data
        },

        cargarDatosMoto( DatosAtv ){
            this.CuentasAtv = DatosAtv
            this.modalstatus=true
        },
    },

    computed:{
        totalgasto(){
            let TotalGasto = 0

            this.CuentasAtv.egresos.forEach(element => {
                TotalGasto += element.cantidad ;
            });

            this.TotalEgreso = TotalGasto
            return TotalGasto
        },

        totalGanancias(){
            let Ganancia = 1800

            let ganancia = parseFloat(Ganancia) - parseFloat(this.TotalEgreso)
            return ganancia
        }
    }

}
</script>

<style scoped>
    .contenidoColor{

        padding: 10px;
        margin: 20px;
    }
    .contenidoColor h1{
        width: 100%;
        text-align: center;
        padding: 5px;
        color: white;
    }
    .contentenido-cuentas{
        display: block;
        margin: 2px;
        text-align: left;
        width: 80px;
        float: left;
    }


    .displaybox{
        float: none;
        clear: both;
    }

    .contenedor{
        width: 100%;
    }
    .contenido_Egresos_ingresos{
        margin-top: 40px;
        width: 100%;

    }


    .cardPersonal{
        display: block;
        border: 1px solid#ccc;
        max-width: 30%;
        min-width: 10%;
        height: 40%;
        padding: 20px;
        margin: 40px;
        float: left;
    }

    .limpiezaFlotado{
        clear: both;
        float: none;
    }
</style>
