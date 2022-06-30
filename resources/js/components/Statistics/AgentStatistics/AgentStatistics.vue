<template>
  <div class="col-md-6 col-lg-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Members By Agent</h3>
      </div>
      <div class="center" v-show="isLoadingAgentStatistics">
        <Loader :isLoading="isLoadingAgentStatistics" />
      </div>
      <div class="card p-2">
        <table
          id="agentStatictsTable"
          class="table card-table"
          v-show="!isLoadingAgentStatistics"
        >
          <thead>
            <tr>
              <th>Agent ID</th>
              <th>Agent Name</th>
              <th>Members</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="item in agentStatistics" :key="item.id">
              <tr>
                <td>{{ item.agentId }}</td>
                <td>{{ item.agentName }}</td>
                <td>
                  <span class="badge bg-success-lt">{{ item.noUsers }}</span>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import useStatistics from "../../../composables/useStatistics";
import Loader from "../../Loader/Loader.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    let agentStaticsTable = "";
    const {
      getAgentStatics,
      agentStatistics,
      isLoadingAgentStatistics,
    } = useStatistics();
    onMounted(() => {
      getAgentStatics().then(() => {
        setTimeout(() => {
          agentStaticsTable = $("#agentStatictsTable").DataTable({
            iDisplayLength: 100,
            lengthChange: false
          });
        }, 2500);
      });
    });
    return { agentStatistics, isLoadingAgentStatistics };
  },
  components: { Loader },
};
</script>

<style lang="scss" scoped>
</style>
