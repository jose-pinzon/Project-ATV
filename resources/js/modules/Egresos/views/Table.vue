<template>
   
   <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">RA0449</a></td>
                      <td>Udin Wayang</td>
                      <td>Nasi Padang</td>
                      <td><span class="badge badge-success">Delivered</span></td>
                      <td><a @click="mostrarMensaje" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    <tr>
                      <td><a href="#">RA5324</a></td>
                      <td>Jaenab Bajigur</td>
                      <td>Gundam 90' Edition</td>
                      <td><span class="badge badge-warning">Shipping</span></td>
                      <td><a  class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    

                  </tbody>
                </table>
    
</template>

<script>
export default {

    data(){
        mensaje:''
    },
    methods:{
        mostrarMensaje(){
            alert('Hola desde el boton de tabla')
        }

    },
}
</script>

<style>

</style>