<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Home</template>
        <template v-slot:page-tittle>RAJA METALS</template>
        <template v-slot:right-side-content>
          <div class="btn-list">
            <span class="d-sm-inline">
              <router-link :to="{ name: 'dashboard' }" class="btn btn-primary">
                DASHBOARD
              </router-link>
            </span>
            <span class="d-sm-inline">
              <router-link
                :to="{ name: 'new-customer' }"
                class="btn btn-primary"
              >
                ADD MEMEBER
              </router-link>
            </span>
            <span class="d-sm-inline">
              <router-link
               :to="{ name: 'open-search' }"
                class="btn btn-primary"
              >
                SEARCH
              </router-link>
            </span>
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
