<template>
    <div>
        <span class="badge " :class="claseAtv()"
        @click="cambiarEstado"
        >{{EstadoText}}</span>
    </div>
</template>

<script>
export default {
    props:{
        estado:{
            type:Boolean,
            require:true
        }
    },
    data(){
        return{
            estadoAtv:true
        }
    },
    mounted(){
        this.estadoAtv = this.estado
    },

    methods:{
        claseAtv(){
            return this.estadoAtv  === true  ? 'badge-success': 'badge-danger'
        },

        cambiarEstado(){
            this.estadoAtv = !this.estadoAtv
        }
    },
    computed:{
        EstadoText(){
            return this.estadoAtv === true ? 'Activa' : 'Inactiva'
        }
    }

}
</script>

<style>

</style>
