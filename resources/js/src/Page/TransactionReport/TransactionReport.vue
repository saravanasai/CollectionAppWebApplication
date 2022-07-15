<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Transaction Reports</template>
        <template v-slot:page-tittle>Transaction Reports</template>
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
            <form action="" @submit.prevent="handleReportFilter">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">From Date</label>
                    <input
                      v-model="fromDate"
                      @change="handleReportFilter"
                      type="date"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Location ID"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">To Date</label>
                    <input
                      v-model="toDate"
                      @change="handleReportFilter"
                      type="date"
                      class="form-control"
                      name="example-text-input"
                      placeholder="Enter Location Name"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="subheader">Total</div>
                      </div>
                      <div class="d-flex align-items-baseline">
                        <div class="h1 mb-0 me-2">{{ total }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="dropdown-divider bt-2"></div>
            <div class="card-body p-0">
              <div class="center" v-show="isLoadingTransaction">
                <Loader :isLoading="isLoadingTransaction" />
              </div>
              <div class="table-responsive">
                <table class="table" id="TransactionReportTable">
                  <thead>
                    <tr>
                      <th><button class="table-sort">Sno</button></th>
                      <th><button class="table-sort">Member ID</button></th>
                      <th><button class="table-sort">Name</button></th>
                      <th>
                        <button class="table-sort">Trnsaction Amount</button>
                      </th>
                      <th><button class="table-sort">Date</button></th>
                    </tr>
                  </thead>

                  <tbody class="table-tbody">
                    <template v-for="(item, i) in transactions" :key="item.id">
                      <tr>
                        <td class="sort-name">
                          {{ ++i }}
                        </td>
                        <td class="sort-city">
                          {{ item.customer?.customerId }}
                        </td>
                        <td class="sort-city">
                          {{ item.customer?.firstName }}
                        </td>
                        <td class="sort-city">
                          {{ item.transactionAmount }}
                        </td>
                        <td class="sort-city">
                          {{ item.created_at }}
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
import useTransaction from "../../../composables/useTransaction";
import { onMounted, ref, toRefs, reactive, computed } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";

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

    let TransactionReporttable = "";

    const state = reactive({
      fromDate: "",
      toDate: "",
      total: 0,
    });

    const { transactions, getAllTransactions, isLoadingTransaction } =
      useTransaction();

    onMounted(() => {
      getAllTransactions().then((e) => {
        setTimeout(() => {
          state.total = totalSum();
          $("#TransactionReportTable").DataTable().destroy();
          TransactionReporttable = $("#TransactionReportTable").DataTable({
            iDisplayLength: 100,
            lengthChange: false,
          });
        }, 2000);
      });
    });

    const handleReportFilter = () => {
      TransactionReporttable.destroy();
      getAllTransactions(state.fromDate, state.toDate).then((e) => {
        setTimeout(() => {
          state.total = totalSum();
          $("#TransactionReportTable").DataTable().destroy();
          TransactionReporttable = $("#TransactionReportTable").DataTable({
            iDisplayLength: 100,
            lengthChange: false,
          });
        }, 2000);
      });
    };

    const totalSum = () => {
      return transactions.value.reduce((total, item) => {
        return (total += Number(item.transactionAmount));
      }, 0);
    };

    return {
      ...toRefs(state),
      transactions,
      isLoadingTransaction,
      handleReportFilter,
      totalSum,
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
