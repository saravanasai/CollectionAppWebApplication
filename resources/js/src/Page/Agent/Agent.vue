<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>All Agents</template>
        <template v-slot:page-tittle>All Agents</template>
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
            <form action="" @submit.prevent="handleAddAgent">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Agent Name</label>
                    <input
                      v-model="agent_name"
                      type="text"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Location Name"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Agent Phone</label>
                    <input
                      v-model="agent_phone"
                      type="number"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Phone Number"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">location</label>
                    <LocationSelect
                      v-model="agent_location_id"
                      :value="agent_location_id"
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
                    Add Agent
                  </button>
                </div>
              </div>
            </form>
            <div class="dropdown-divider bt-2"></div>
            <div class="card-body p-0">
              <div class="center" v-show="isLoadingAgent">
                <Loader :isLoading="isLoadingAgent" />
              </div>
              <div class="table-responsive">
                <table class="table" id="agentTable">
                  <thead>
                    <tr>
                      <th><button class="table-sort">Sno</button></th>
                      <th><button class="table-sort">Agent ID</button></th>
                      <th><button class="table-sort">Agent Name</button></th>
                      <th><button class="table-sort">Agent Phone</button></th>
                      <th><button class="table-sort">Location</button></th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody class="table-tbody">
                    <template v-for="(item, i) in agents" :key="item.id">
                      <tr>
                        <td class="sort-name">
                          {{ ++i }}
                        </td>
                        <td class="sort-city">
                          {{ item.agentId }}
                        </td>
                        <td class="sort-city">
                          {{ item.agentName }}
                        </td>
                        <td class="sort-city">
                          {{ item.agentPhone }}
                        </td>
                        <td class="sort-city">
                          {{ item.agentLocation?.locationName }}
                        </td>
                        <td>
                            <router-link :to="{name:'agent-edit',params:{id:item.id}}" class="btn btn-dark">
                                Edit
                            </router-link>
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
import useAgent from "../../../composables/useAgent";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";

export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
    LocationSelect,
    BackButton,
  },
  setup() {
    const { router, route } = useNavigation();

    let agentTable = "";

    const state = reactive({
      agent_phone: "",
      agent_name: "",
      agent_location_id: 0,
    });

    const { agents, getAgents, addAgent, isLoadingAgent } = useAgent();

    onMounted(() => {
      getAgents();

      setTimeout(() => {
        agentTable = $("#agentTable").DataTable({
          iDisplayLength: 100,
          lengthChange: false,
        });
      }, 2000);
    });

    const handleAddAgent = () => {
      let data = {
        agent_name: state.agent_name,
        agent_phone: state.agent_phone,
        agent_location_id: state.agent_location_id,
      };

      addAgent(data).then((e) => {
        if (e.status === 201) {
          getAgents();
          Toast.open({
            message: "New Agent Added",
            duration: 1500,
          });
          state.agent_phone = "";
          state.agent_name = "";
          state.agent_location_id = 0;
          agentTable.destroy();

          setTimeout(() => {
            $("#agentTable").DataTable({
              iDisplayLength: 100,
              lengthChange: false,
            });
          }, 2000);
        }
      });
    };

    return {
      ...toRefs(state),
      agents,
      isLoadingAgent,
      handleAddAgent,
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
