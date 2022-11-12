<template>

        <div class="col-sm-4 cardMo">
                <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Numero Moto: {{ moto.numero_Atv }}</h3>
                    <h5 class="card-title">{{ moto.placa }}</h5>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModalScrollable"  @click="$emit('MostrarIngEgre',moto)" id="#modalScroll" >Ver ingreso y egresos</button>
                </div>
                </div>
            </div>

</template>

<script>
import { defineAsyncComponent } from 'vue'

export default {
    props:['moto'],
    components:{
        Modal:defineAsyncComponent(() => import('../components/modalDetalle.vue')),
    },


}
</script>

<style scoped>
     .cardMo{
        margin-top: 20px;
    }
</style>
