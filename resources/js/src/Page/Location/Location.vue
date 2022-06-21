<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>All Locations</template>
        <template v-slot:page-tittle>All Locations</template>
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
            <a
              href="#"
              class="btn btn-primary d-sm-none btn-icon"
              data-bs-toggle="modal"
              data-bs-target="#modal-report"
              aria-label="Create new report"
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
            </a>
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <div class="card p-md-5 m-sm-2">
        <div class="conatiner">
          <div class="card p-3">
            <form action="" @submit.prevent="handleAddLocation">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Location ID</label>
                    <input
                      v-model="location_id"
                      type="number"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Location ID"
                    />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Location Name</label>
                    <input
                      v-model="location_name"
                      type="text"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Location Name"
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
                    Add Location
                  </button>
                </div>
              </div>
            </form>
            <div class="dropdown-divider bt-2"></div>
            <div class="card-body p-0">
              <div class="center" v-show="isLoadingLocation">
                <Loader :isLoading="isLoadingLocation" />
              </div>
              <table class="table" id="locationTable">
                <thead>
                  <tr>
                    <th><button class="table-sort">Sno</button></th>
                    <th><button class="table-sort">Location ID</button></th>
                    <th><button class="table-sort">Location Name</button></th>
                  </tr>
                </thead>

                <tbody class="table-tbody">
                  <template v-for="(item, i) in locations" :key="item.id">
                    <tr>
                      <td class="sort-name">
                        {{ ++i }}
                      </td>
                      <td class="sort-city">
                        {{ item.locationId }}
                      </td>
                      <td class="sort-city">
                        {{ item.locationName }}
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
import useLocation from "../../../composables/useLocation";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
  },
  setup() {
    const { router, route } = useNavigation();

    let table = "";

    const state = reactive({
      location_id: "",
      location_name: "",
    });

    const { locations, getLocations, addLocation, isLoadingLocation } =
      useLocation();

    onMounted(() => {
      getLocations();

      setTimeout(() => {
        table = $("#locationTable").DataTable();
      }, 2000);
    });

    const handleAddLocation = () => {
      let data = {
        location_id: state.location_id,
        location_name: state.location_name,
      };

      addLocation(data).then((e) => {
        if (e.status === 201) {
          Toast.open({
            message: "New Location Added",
            duration: 1500,
          });
          state.location_id = "";
          state.location_name = "";
          table.destroy();
          getLocations();
          setTimeout(() => {
            $("#locationTable").DataTable();
          }, 2000);
        }
      });
    };

    return {
      ...toRefs(state),
      locations,
      isLoadingLocation,
      handleAddLocation,
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
