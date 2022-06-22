<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>All Schemes</template>
        <template v-slot:page-tittle>All Schemes</template>
        <template v-slot:right-side-content>
          <div class="btn-list">
            <span class="d-none d-sm-inline">
              <router-link :to="{ name: 'home' }" class="btn btn-dark"
                >Home</router-link
              >
            </span>
            <router-link
              class="btn btn-primary d-none d-sm-inline-block"
              :to="{ name: 'dashboard' }"
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
              Dashboard
            </router-link>
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <div class="card p-md-5 m-sm-2">
        <div class="conatiner">
          <div class="card p-3">
            <form action="" @submit.prevent="handleAddScheme">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Scheme Name</label>
                    <input
                      v-model="scheme_name"
                      type="text"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Scheme Name"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input
                      v-model="scheme_start_date"
                      type="date"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Start Date"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input
                      v-model="scheme_end_date"
                      type="date"
                      class="form-control"
                      name="example-text-input"
                      placeholder="End Date"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 offset-md-9 col-sm-12">
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
                    Add Scheme
                  </button>
                </div>
              </div>
            </form>
            <div class="dropdown-divider bt-2"></div>
            <div class="card-body p-0">
              <div class="center" v-show="isLoadingScheme">
                <Loader :isLoading="isLoadingScheme" />
              </div>
              <table class="table" id="schemeTable">
                <thead>
                  <tr>
                    <th><button class="table-sort">Sno</button></th>
                    <th><button class="table-sort">Scheme Name</button></th>
                    <th><button class="table-sort">Start Date</button></th>
                    <th><button class="table-sort">End Date</button></th>
                  </tr>
                </thead>

                <tbody class="table-tbody">
                  <template v-for="(item, i) in schemes" :key="item.id">
                    <tr>
                      <td class="sort-name">
                        {{ ++i }}
                      </td>
                      <td class="sort-city">
                        {{ item.schemeName }}
                      </td>
                      <td class="sort-city">
                        {{ item.startDate }}
                      </td>
                      <td class="sort-city">
                        {{ item.endDate }}
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
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
import useScheme from "../../../composables/useScheme";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";

export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
    LocationSelect,
  },
  setup() {
    const { router, route } = useNavigation();

    let schemeTable = "";

    const state = reactive({
      scheme_name: "",
      scheme_start_date: "",
      scheme_end_date: "",
    });

    const { schemes, getSchemes, addScheme, isLoadingScheme } = useScheme();

    onMounted(() => {
      getSchemes();

      setTimeout(() => {
        schemeTable = $("#schemeTable").DataTable();
      }, 2000);
    });

    const handleAddScheme = () => {
      let data = {
        scheme_name: state.scheme_name,
        scheme_start_date: state.scheme_start_date,
        scheme_end_date: state.scheme_end_date,
      };

      addScheme(data).then((e) => {
        if (e.status === 201) {
          getSchemes();
          Toast.open({
            message: "New Scheme Added",
            duration: 1500,
          });
          state.scheme_name = "";
          state.scheme_start_date = "";
          state.scheme_end_date = "";
          schemeTable.destroy();

          setTimeout(() => {
            $("#schemeTable").DataTable();
          }, 2000);
        }
      });
    };

    return {
      ...toRefs(state),
      schemes,
      isLoadingScheme,
      handleAddScheme,
    };
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
