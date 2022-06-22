<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Home</template>
        <template v-slot:page-tittle> Collection Manager </template>
        <template v-slot:right-side-content>
          <div class="btn-list">
            <span class="d-none d-sm-inline">
              <router-link :to="{name:'dashboard'}" class="btn btn-dark"> Dashboard </router-link>
            </span>
            <router-link

              :to="{name:'new-customer'}"
              class="btn btn-primary d-sm-none btn-icon"
            >
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
            </router-link>
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <hero-card />
    </template>
  </MainLayout>
</template>

<script>
import Tittle from "../../layout/Tittle/Tittle.vue";
import MainLayout from "../../layout/Main/Main.vue";
import HeroCard from "../../../components/Widget/HeroCard/HeroCard.vue";
export default {
  components: { Tittle, MainLayout, HeroCard },
  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
</style>
