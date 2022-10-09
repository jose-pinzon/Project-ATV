<template>
    <p>{{datos}}</p>
</template>

<script>
export default {
    props:{
        datos:{
            type:Object,
            require:true
        }
    },
    data(){
        return{
            editAtv:null
        }
    },

    // watch:{
    //     props
    // }





}
</script>

<style scoped>
    p{
        background-color: aqua;  
    }
</style>