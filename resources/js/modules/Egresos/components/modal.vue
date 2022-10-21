<template>
    <section>

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">

                <slot name="Titulo">  </slot>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <slot name="contenido"></slot>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                </div>
                </div>
            </div>
          </div>
        </section>
</template>

<script>
export default {

}
</script>

<style>

</style>
