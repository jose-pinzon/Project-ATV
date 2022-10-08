<template>
    <section>
    <button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable"
                        id="#myBtn">
                      Ver detalles
        </button> 
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">Modal scrollable title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5 class="font-weight-bold">Title</h5>
                    {{datosDetalle}}
                  <h5 class="font-weight-bold">Title</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Lacinia quis vel eros donec. Nec tincidunt praesent semper feugiat nibh sed
                    pulvinar proin gravida. Urna cursus eget nunc scelerisque viverra mauris in. Risus sed vulputate
                    odio ut enim blandit volutpat maecenas. Etiam sit amet nisl purus in mollis nunc. Aliquet bibendum
                    enim facilisis gravida neque convallis a. Aliquam id diam maecenas ultricies mi eget mauris. Et
                    malesuada fames ac turpis egestas sed. Venenatis cras sed felis eget.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </section>
</template>

<script>
export default {
    props:{
        detalles:{
            type: Object,
            require: true
        }
    },
    data() {
        return{
            datosDetalle:''
        }
    },

   

}
</script>

<style>

</style>