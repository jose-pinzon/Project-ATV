<template>
    <section>
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">
                    <slot name="Titulo"></slot>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <slot name="contenido"></slot>
                  {{datos}}
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
        </section>
</template>

<script>
export default {
    props:['datos']

}
</script>

<style>

</style>
