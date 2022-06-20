<template>
  <div class="page-wrapper">
    <div class="container-xl">
      <slot name="top-section">Top section</slot>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import { inject, onMounted } from "@vue/runtime-core";
import useAuth from "../../../composables/useAuth";
export default {
  setup() {
    const { updateAuthState } = inject("store");
    const { isAuthenticated,removeAuthToken } = useAuth();

    onMounted(() => {
      if (isAuthenticated()) {

        updateAuthState(true);
      } else {
        updateAuthState(false);
        removeAuthToken()
      }
    });
  },
};
</script>

<style lang="scss" scoped>
</style>
