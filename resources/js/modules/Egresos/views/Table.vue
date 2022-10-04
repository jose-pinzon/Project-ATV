<template>

    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
      </div>
      <div class="table-responsive">
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
            <td>
                <a @click="mostrarMensaje" class="btn btn-sm btn-primary">Detail</a>
            </td>
            </tr>
            <tr>
              <td><a href="#">RA5324</a></td>
              <td>Jaenab Bajigur</td>
              <td>Gundam 90' Edition</td>
              <td><span class="badge badge-warning">Shipping</span></td>
              <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>

          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
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