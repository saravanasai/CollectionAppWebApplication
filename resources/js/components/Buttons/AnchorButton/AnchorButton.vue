<template>
  <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
    <router-link :to="{ name: To }" :class="`btn btn-${btnColor} w-100`">
      {{ btnTxt }}
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    btnColor: {
      type: String,
      default: "primary",
    },
    btnTxt: {
      type: String,
      default: "button Text",
    },
    To: {
      type: String,
      default: "home",
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
