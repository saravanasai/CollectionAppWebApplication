<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>All Plans</template>
        <template v-slot:page-tittle>All Plans</template>
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
      <div class="card p-md-5 m-sm-2">
        <div class="conatiner">
          <div class="card p-3">
            <form action="" @submit.prevent="handleAddPlan">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Plan Amount</label>
                    <input
                      v-model="planAmount"
                      type="number"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Plan Amount"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2 offset-md-10 col-sm-12">
                  <button type="submit" class="btn btn-primary">
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
                    Add Plan
                  </button>
                </div>
              </div>
            </form>
            <div class="dropdown-divider bt-2"></div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Plan Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    <tr v-show="isLoadingPlan">
                      <td colspan="2">
                        <Loader :isLoading="isLoadingPlan" />
                      </td>
                    </tr>
                    <template v-for="(item, i) in plans" :key="item.id">
                      <tr>
                        <td class="sort-name">
                          {{ ++i }}
                        </td>
                        <td class="sort-city">
                          {{ item.amount }}
                        </td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import MainLayout from "../../layout/Main/Main.vue";
import Tittle from "../../layout/Tittle/Tittle.vue";
import Loader from "../../../components/Loader/Loader.vue";
import usePlan from "../../../composables/usePlan";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
undefined;
undefined;
export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
    BackButton,
  },
  setup() {
    const { router, route } = useNavigation();

    const planAmount = ref("");

    const { plans, getPlan, addPlan, isLoadingPlan } = usePlan();

    onMounted(() => {
      getPlan();
    });

    const handleAddPlan = () => {
      let data = {
        amount: planAmount.value,
      };

      addPlan(data).then((e) => {
        if (e.status == 201) {
          Toast.open({
            message: "New Plan Added",
            duration: 1500,
          });
          getPlan();
          planAmount.value = "";
        }
      });
    };

    return { plans, isLoadingPlan, planAmount, handleAddPlan };
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
