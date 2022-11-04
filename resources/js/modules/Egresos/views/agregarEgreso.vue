<template>
    <div>
        <section v-if="errors" class="col-md-6 alerts-contenido" >
            <div v-for="e in errors" :key="e[0]" class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><i class="fas fa-ban"></i><b> Stop!</b></h6>
                   {{e[0]}}!
            </div>
        </section>

        <div v-if="mensaje" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><i class="fas fa-check"></i><b> Guardado!</b></h6>
                    {{mensaje}}
        </div>

        <form @submit.prevent="agregar">
            <section class="row justify-content-center">
                <div class="col-md">
                    <label for="atv">Seleccione atv :</label>
                    <select id="atv" class="select2-single form-control " v-model="ValoresEgreso.moto_id" name="state" >
                        <option value="">Select</option>
                        <option v-for="atv in Atvs"  :key="atv.id" :value="atv.id">{{atv.numero_Atv}} -  {{atv.color}} </option>
                    </select>
                </div >

                <div class="col-md">
                    <label for="">Tipo de gasto : </label>
                    <input type="text"  class="form-control" v-model="ValoresEgreso.tipo_gasto">
                </div>
            </section>

            <section class="row justify-content-center">
                <div class="col-md-4">
                    <label >
                        Colocar cantidad usada :</label>
                        <input type="number" class="form-control" v-model="ValoresEgreso.cantidad">
                </div>

                <div class="col-md">
                    <label for="">Descripcion del gasto :</label>
                    <textarea class="form-control" v-model="ValoresEgreso.gasto" height="30"  ></textarea>
                    <!-- <input type="text" class="form-control" v-model="ValoresEgreso.gasto" > -->
                </div>
                <!-- <div class="col-md-4">
                    <label >
                        Colocar cantidad usada:</label>
                        <input type="number" class="form-control">
                </div> -->
            </section>

            <input type="submit" value="Guardar" class="btn btn-primary">
        </form>

    </div>
</template>

<script>
 import AtvApi from '../../../api/AtvApi'
export default {

    data(){
        return{
            Atvs:null,
            ValoresEgreso:{
                tipo_gasto:'',
                gasto:'',
                cantidad:0,
                moto_id:''
            },
            errors:{},
            mensaje:''
        }
    },
    mounted(){
        this.getAtv()
    },

    methods:{
        async getAtv(){
                const { data } = await AtvApi.get('/motos')
                    this.Atvs = data.MotosAll
        },

        async agregar(){
            try {
                const { data } = await AtvApi.post('/egresoAtv',this.ValoresEgreso)
                this.ValoresEgreso.tipo_gasto = ''
                this.ValoresEgreso.gasto = ''
                this.ValoresEgreso.cantidad = 0
                this.ValoresEgreso.moto_id = ''
                this.errors = {}

                this.$swal.fire(
                    'Finalizado',
                    data.message,
                    'success'
                )

            } catch (error) {
                if( error.response.status === 422){
                        this.errors = error.response.data.errors
                }
            }

        }
    }

}
</script>
<style scoped>
    .alerts-contenido{
        margin: 0px auto;
    }

</style>
