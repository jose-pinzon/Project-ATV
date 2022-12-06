<template >
        <tbody>

                    <tr v-for="egreso in datosEgresos" :key="egreso.id">
                        <td>{{egreso.tipo_gasto}}</td>
                        <td>{{egreso.gasto}}</td>
                        <td>{{egreso.cantidad}} Pesos</td>
                        <td>{{egreso.moto.numero_Atv}} - {{egreso.moto.color}}</td>
                        <!-- <td></td> -->
                        <td>
                            <moment :fecha="egreso.fecha"></moment>
                        </td>
                        <td>
                            <a @click="$emit('eliminar', egreso.id)" class="btn btn-danger text-white font-bold"> Eliminar </a>
                        </td>
                    </tr>
        </tbody>
</template>
<script>
import { defineAsyncComponent } from 'vue'
export default {
    components:{
        moment: defineAsyncComponent(()=>import('../../../components/moments.vue'))
    },
    props:{
        datosEgresos:{
            type:Array,
            require:true
        }
    },
    methods:{

    }

}
</script>
