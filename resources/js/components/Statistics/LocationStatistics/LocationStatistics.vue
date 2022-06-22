<template>
  <div class="col-md-6 col-lg-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Members On Location</h3>
      </div>
      <div class="center" v-show="isLoadingLocationStatistics">
        <Loader :isLoading="isLoadingLocationStatistics" />
      </div>
        <div class="card p-2">
      <table
        id="locationStatictsTable"
        class="table card-table"
        v-show="!isLoadingLocationStatistics"
      >
        <thead>
          <tr>
            <th>Location Name</th>
            <th>Members</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="item in locationStatistics" :key="item.id">
            <tr>
              <td>{{ item.locationName }}</td>
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
    let locationStaticsTable = "";
    const {
      getLocationStatics,
      locationStatistics,
      isLoadingLocationStatistics,
    } = useStatistics();
    onMounted(() => {
      getLocationStatics().then(() => {

         setTimeout(()=>{
                 locationStaticsTable = $("#locationStatictsTable").DataTable();
            },2500)

      });
    });
    return { locationStatistics, isLoadingLocationStatistics };
  },
  components: { Loader },
};
</script>

<style lang="scss" scoped>
</style>
