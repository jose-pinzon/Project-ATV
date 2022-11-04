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
                            <a @click="eliminar" class="btn btn-danger"> Eliminar </a>
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
        eliminar(){
            const swalWithBootstrapButtons = this.$swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                        title: '¿Esta seguro de eliminar este registro?',
                        text: "Una vez eliminado ya no se podra recuperarr",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Aceptar !',
                        cancelButtonText: 'Cancelar !',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // AtvApi.post(`/motoAtv/${ id }`, params).then(res =>{
                            //     this.getAtv()
                                swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Eliminado de pruebas',
                                // `${res.data.message}`,
                                'success'
                                )
                            // }).
                            // catch(e => {
                            //     console.log(e);
                            // })
                            }
                        })
        }

    }

}
</script>
