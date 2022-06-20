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
      <div class="row">
        <div class="col-12">
          <div class="card card-md">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="h3">
                    Expense-Tracker . Track Your Spending like Pro.
                  </h2>
                  <p class="m-0 text-muted">
                    Also known as expense manager and money manager, an expense
                    tracker is a software or application that helps to keep an
                    accurate record of your money inflow and outflow. Many
                    people in India live on a fixed income, and they find that
                    towards the end of the month they don't have sufficient
                    money to meet their needs.
                  </p>
                </div>
                <div class="col-auto">
                  <router-link
                    :to="{ name: 'home' }"
                    class="btn btn-primary d-none d-sm-inline-block"
                  >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    Track Now
                  </router-link>
                </div>
              </div>
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

<style lang="scss" scoped>
</style>
