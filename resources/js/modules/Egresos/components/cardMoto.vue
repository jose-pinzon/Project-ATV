<template>

        <div class="col-sm-4 cardMo">
                <div class="card" style="width: 18rem;">
                    <img :src="imagenMostrar" class="card-img-top" alt="Sin imagen">
                    <div class="card-body">
                        <h5 class="card-title">Numero Moto: {{ moto.numero_Atv }}</h5>
                        <p class="card-text">{{ moto.placa }}</p>
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
    computed:{
        imagenMostrar(){
            return `/storage/motos/${this.moto.imagen}`
        }
    }


}
</script>

<style scoped>
     .cardMo{
        margin-top: 20px;
    }
</style>
