<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Complement Reports</template>
        <template v-slot:page-tittle>Complement Advance Reports</template>
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
      <div class="card p-md-5 p-sm-2">
        <div class="row m-2">
          <div class="col-md-3 col-sm-12">
            <label class="form-label">location</label>
            <LocationSelect
              @change="handleFilter"
              v-model="locactionId"
              :value="locactionId"
            />
          </div>
          <div class="col-md-3 col-sm-12">
            <label class="form-label">Agent</label>
            <AgentSelect
              @change="handleFilter"
              v-model="agentId"
              :value="agentId"
            />
          </div>
          <div class="col-md-3 col-sm-12">
            <label class="form-label">Plan</label>
            <PlanSelect
              @change="handleFilter"
              v-model="planId"
              :value="planId"
            />
          </div>
           <div class="col-md-3 col-sm-12">
            <label class="form-label">Complement</label>
            <ComplementSelect
              @change="handleFilter"
              v-model="complementOption"
              :value="complementOption"
            />
          </div>
        </div>
        <div class="card-header justify-content-center"></div>
        <div
          class="list-group list-group-flush overflow-auto"
          style="max-height: 35rem"
        >
          <Loader :isLoading="isLoadingCustomer" />
          <ComplementReportTable
            :tableId="'advanceComplementExportTable'"
            :headers="[
              'Sno',
              'CustomerID',
              'F-Name',
              'S-Name',
              'P-Phone',
              'Plan',
              'Location',
              'Agent',
              'Complement 1',
              'Complement 2',
            ]"
            :data="customers"
            v-if="!isLoadingCustomer"
          />
        </div>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import MainLayout from "../../layout/Main/Main.vue";
import Tittle from "../../layout/Tittle/Tittle.vue";
import Loader from "../../../components/Loader/Loader.vue";
import useCustomer from "../../../composables/useCustomer";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";
import AgentSelect from "../../../components/SelectBox/AgentSelect/AgentSelect.vue";
import PlanSelect from "../../../components/SelectBox/PlanSelect/PlanSelect.vue";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
import ComplementReportTable from "../../../components/Tables/ComplementReportTable/ComplementReportTable.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import "datatables.net-buttons/js/dataTables.buttons.js";
import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-buttons/js/buttons.flash.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.print.js";
import $ from "jquery";
import ComplementSelect from "../../../components/SelectBox/ComplementSelect/ComplementSelect.vue";
export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
    LocationSelect,
    AgentSelect,
    PlanSelect,
    BackButton,
    ComplementReportTable,
    ComplementSelect
},
  setup() {
    let reportsAdvanceTable = "";

    const state = reactive({
      searchKey: "",
      agentId: 0,
      locactionId: 0,
      planId: 0,
      planAmount: 0,
      complementOption: 0,
    });

    const { router, route } = useNavigation();

    const { customers, getCustomers, isLoadingCustomer } = useCustomer();

    onMounted(() => {
      getCustomers(
        state.searchKey,
        state.locactionId,
        state.agentId,
        state.planId,
        state.planAmount,
        0
      ).then((e) => {
        setTimeout(() => {

          loadDataTable();
        }, 2000);
      });
    });

    const loadDataTable = () => {

        $("#advanceComplementExportTable").DataTable().destroy()

      reportsAdvanceTable = $("#advanceComplementExportTable").DataTable({
        iDisplayLength: 100,
        lengthChange: false,
        searching: false,
        dom: "Bfrtip",
        buttons: [
          {
            extend: "csv",
            className: "btn btn-primary glyphicon glyphicon-save-file  mb-3",
          },
          {
            extend: "print",
            className: "btn btn-primary glyphicon glyphicon-print  mb-3",
          },
        ],
      });
    };

    const handleFilter = () => {
      getCustomers(
        state.searchKey,
        state.locactionId,
        state.agentId,
        state.planId,
        state.planAmount,
        state.complementOption,
        0
      ).then((e) => {
        setTimeout(() => {
          loadDataTable();
        }, 2000);
      });
    };
    return { ...toRefs(state), customers, handleFilter, isLoadingCustomer };
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
