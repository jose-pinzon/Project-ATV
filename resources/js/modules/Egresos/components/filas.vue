<template>

    <tbody>
        <tr v-for="d in datosP" :key="d.id">
            <td hidden> {{ d.id }}</td>
            <td><a href="#">{{ d.numero_Atv }}</a></td>
            <td>{{ d.placa }}</td>
            <td>{{ d.num_serie }}</td>
            <td>{{ d.propietario }}</td>
            <td>
                <estado :estado="d.estado"></estado>

            </td>
            <td>
                <a @click="$emit('buttonEditar', d)" class="btn btn-sm btn-primary text-white">Detail</a>
                <a @click="$emit('buttonEliminar', d.id)" class="btn btn-sm btn-danger text-white">Eliminar</a>
            </td>
        </tr>
    </tbody>
</template>



<script>
import { defineAsyncComponent } from 'vue'

export default {
    name:'filas',
    components:{
        estado: defineAsyncComponent(()=> import('./estado.vue')),
        AtvDetalles: defineAsyncComponent(()=> import('./modalDetalle.vue'))

    },
    props:{
        datosP:{
            typeof:Array,
            require:true
        }
    }
}
</script>


