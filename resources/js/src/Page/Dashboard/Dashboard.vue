<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>My Dashboard</template>
        <template v-slot:page-tittle>My Collection Dashboard </template>
        <template v-slot:right-side-content>
          <div class="btn-list float-end">
            <span class="d-sm-inline">
              <router-link :to="{ name: 'home' }" class="btn btn-dark"
                >Home</router-link
              >
            </span>
            <BackButton />
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <div class="card p-md-5 p-sm-1">
        <div class="row row-deck row-cards">
          <DashboardCard
            :Tittle="'Members'"
            :SubTittle="'Total Members'"
            :Total="dashboardStatistics.userCount"
            :BarColor="'success'"
            :To="'all-customer'"
            :BtnText="'Member List'"
          />
          <DashboardCard
            :Tittle="'Agents'"
            :SubTittle="'Total Agents'"
            :Total="dashboardStatistics.agentCount"
            :BarColor="'primary'"
            :To="'agents'"
            :BtnText="'Agent List'"
          />
          <DashboardCard
            :Tittle="'Estimated Collection'"
            :SubTittle="'Amount Need To be Colected'"
            :Total="dashboardStatistics.TotalCollection"
            :BarColor="'yellow'"
            :To="'advance-filter'"
            :BtnText="'Adavance FIlter'"
          />

          <DashboardCard
            :Tittle="'Current Total'"
            :SubTittle="'Total Amount Collected'"
            :Total="
              dashboardStatistics.TotalCollection -
              dashboardStatistics.TotalCollectionBalance
            "
            :To="'reports'"
            :BtnText="'Transactions'"
          />
          <PlanStatistics />
          <LocationStatistics />
          <AgentStatistics />
        </div>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import MainLayout from "../../layout/Main/Main.vue";
import Tittle from "../../layout/Tittle/Tittle.vue";
import Loader from "../../../components/Loader/Loader.vue";
import BookCard from "../../../components/Widget/BookCard/BookCard.vue";
import SimpleModal from "../../../components/Modal/SimpleModel.vue";

import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import DashboardCard from "../../../components/Widget/DashboardCard/DashboardCard.vue";
import PlanStatistics from "../../../components/Statistics/PlanStatistics/PlanStatistics.vue";
import LocationStatistics from "../../../components/Statistics/LocationStatistics/LocationStatistics.vue";
import useStatistics from "../../../composables/useStatistics";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
import AgentStatistics from "../../../components/Statistics/AgentStatistics/AgentStatistics.vue";
export default {
  components: {
    MainLayout,
    Tittle,
    BookCard,
    SimpleModal,
    Loader,
    DashboardCard,
    PlanStatistics,
    LocationStatistics,
    BackButton,
    AgentStatistics
},
  setup() {
    const {
      dashboardStatistics,
      getDashboardStatics,
      isLoadingDashboardStatistics,
    } = useStatistics();

    onMounted(() => {
      getDashboardStatics();
    });

    return { dashboardStatistics };
  },
};
</script>

<style>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 15;
}
</style>
