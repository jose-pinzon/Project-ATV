<template >
        <tbody>

                    <tr v-for="egreso in datosEgresos" :key="egreso.id">
                        <td>{{egreso.tipo_gasto}}</td>
                        <td>{{egreso.gasto}}</td>
                        <td>{{egreso.cantidad}} Pesos</td>
                        <td>{{egreso.moto.numero_Atv}} - {{egreso.moto.color}}</td>
                        <td>
                            <moment :fecha="egreso.created_at"></moment>
                        </td>
                        <td>
                            <a href="" class="btn btn-primary"> boton </a>
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
    }

}
</script>
