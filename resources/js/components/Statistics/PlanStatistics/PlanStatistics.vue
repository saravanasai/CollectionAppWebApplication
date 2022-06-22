<template>
  <div class="col-md-6 col-lg-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Members On Plan</h3>
      </div>
      <div class="center" v-show="isLoadingPlanStatistics">
        <Loader :isLoading="isLoadingPlanStatistics" />
      </div>
      <div class="card p-2">
         <table
        class="table card-table "
        id="planStatictsTable"
        v-show="!isLoadingPlanStatistics"
      >
        <thead>
          <tr>
            <th>Plan</th>
            <th>Members</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="item in planStatistics" :key="item.id">
            <tr>
              <td>{{ item.plan }}</td>
              <td >
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
    let planStaticsTable = "";
    const { planStatistics, getPlanStatics, isLoadingPlanStatistics } =
      useStatistics();
    onMounted(() => {
      getPlanStatics().then(()=>{


            setTimeout(()=>{
                planStaticsTable = $("#planStatictsTable").DataTable();
            },2500)

      });

    });
    return { planStatistics, isLoadingPlanStatistics };
  },
  components: { Loader },
};
</script>

<style lang="scss" scoped>
</style>
