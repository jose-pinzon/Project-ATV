<template>
    <div>
        <h1>Detalles de la moto</h1>
        <hr>
    <div class="part1">
        <p><span>Numero Cuatrimoto :</span>  {{datos.numero_Atv}}  </p>
        <p><span>Velocidad Maxima :</span>  {{datos.max_velocidad}}  </p>
        <p><span>Numero de placa :</span>  {{datos.placa}}  </p>
        <p><span>Numero de serie :</span>  {{datos.num_serie}}  </p>
        <p><span>Numero de motor :</span>  {{datos.num_motor}}  </p>
    </div>
    <div class="part2">
        <p><span>Propietario :</span>  {{datos.propietario}}  </p>
        <p><span>Marca :</span>  {{datos.marca}}  </p>
        <p><span>Modelo :</span>  {{datos.modelo}}  </p>
        <p><span>Color :</span>  {{datos.color}}  </p>
    </div>
    <div class="display-fix"></div>
</div>
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
           
        }
    },

}
</script>

<style scoped>
    h1{
        font-size:40px ;
    }
    span{
        font-weight: bold;
    }

    .part1{
        display: block;
        float: left;
        padding:2em;
    }

    .part2{
        display: block;
        padding: 2em;
    }  

    .display-fix{
        float: none;
        clear: both;
    }
</style>