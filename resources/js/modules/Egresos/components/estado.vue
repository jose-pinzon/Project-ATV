<template>
    <div>
        <span class="badge" :class="claseAtv()"
        @click="cambiarEstado"
        >{{EstadoText}}</span>
    </div>


</template>s

<script>
 import AtvApi from '../../../api/AtvApi'
export default {
    props:{
        estado:{
            type:Number,
            require:true
        },
        moto_id:{
            type:Number,
            require:true
        }
    },
    data(){
        return{
            estadoAtv:null
        }
    },
    mounted(){
        this.estadoAtv = Number(this.estado)
    },

    methods:{
        claseAtv(){
            return this.estadoAtv  === 1  ? 'badge-success': 'badge-danger'
        },

        async cambiarEstado(){
            this.estadoAtv == 1 ? this.estadoAtv = 0 : this.estadoAtv = 1
            // !Los params se leen con el request
            const params = {
                estado:this.estadoAtv
            }

            const { data } = await AtvApi.post(`/motos/${this.moto_id}`, params)
            console.log(data);
        }
    },
    computed:{
        EstadoText(){
            return this.estadoAtv === 1 ? 'Activa' : 'Inactiva'
        }
    }

}
</script>

<style>

</style>
