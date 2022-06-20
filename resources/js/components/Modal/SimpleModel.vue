<template>
<div class="modal modal-blur fade show" id="modal-simple" tabindex="-1" role="dialog" style="display: block;" aria-modal="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{modelTittle}}</h5>
            <button type="button" @click="handleClose" class="btn-close"  aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <slot name="body">

              </slot>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" @click="handleClose">Close</button>
            <button type="button" class="btn btn-primary" @click="handleSubmit" >{{btnText}}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</template>

<script>
export default {

    props:{
      handleClose:Function,
      handleSubmit:Function,
      modelTittle:String,
      btnText:String,
    },
    setup()
    {
    return {}
    }
}
</script>

<style scoped>

</style>
