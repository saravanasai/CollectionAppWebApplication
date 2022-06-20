<template>
 <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>About</template>
        <template v-slot:page-tittle> About Expense Manager </template>
        <template v-slot:right-side-content>
          <div class="btn-list">
            <span class="d-none d-sm-inline">
              <router-link :to="{ name: 'home' }" class="btn btn-dark">
                Home
              </router-link>
            </span>
            <button
              type="button"
              class="btn btn-primary d-none d-sm-inline-block"
              @click="this.$router.go(-1)"
            >
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              Back
            </button>
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <div class="page page-center">
    <div class="container-tight py-4">
      <div class="empty">
        <div class="empty-header">404</div>
        <p class="empty-title">Oops… You just found an error page</p>
        <p class="empty-subtitle text-muted">
          We are sorry but the page you are looking for was not found
        </p>
        <div class="empty-action">
          <router-link :to="{name:'home'}" class="btn btn-primary">
            Take me home
          </router-link>
        </div>
      </div>
    </div>
  </div>
    </template>
  </MainLayout>

</template>

<script>
import Tittle from "../../layout/Tittle/Tittle.vue";
import MainLayout from "../../layout/Main/Main.vue";
export default {
  components: { Tittle, MainLayout },
};
</script>
<style>
</style>
