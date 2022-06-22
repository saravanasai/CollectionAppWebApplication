<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Customer Transaction</template>
        <template v-slot:page-tittle>Customer Transaction Details</template>
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
      <div class="card">
        <div class="row row-cards p-3">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="subheader my-2">Member Information</div>
                <div class="h5 my-1">
                  <span>Member - ID : </span>{{ customer.customerId }}
                </div>
                <div class="h5 my-1">
                  <span>Name : </span>{{ customer.firstName }}
                </div>
                <div class="h5 my-1">
                  <span>Phone : </span>{{ customer.primaryPhone }}
                </div>
                <div class="h5 my-1">
                  <span>Location : </span>{{ customer.location?.locationName }}
                </div>
                <div class="h5">
                  <span>Plan : </span
                  ><span class="badge bg-green-lt"
                    >{{ customer.plan?.amount }}-Rs/</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="subheader">Collection Total</div>
                <div class="h3 my-2">
                  {{ customer.collection?.collection_total_due }}
                </div>
                <div class="subheader">Collection Balance</div>
                <div class="h3 my-2">
                  {{ customer.collection?.collection_balance_due }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="subheader">Total Transaction</div>
                <div class="h3 m-0">{{ customerTransactionsTotal }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3 p-3">
          <div class="container-xl">
            <div class="card">
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th><button class="table-sort">TR-ID</button></th>
                      <th><button class="table-sort">Amount</button></th>
                      <th><button class="table-sort">Date</button></th>
                    </tr>
                  </thead>

                  <tbody class="table-tbody">
                    <tr>
                      <td colspan="3">
                        <Loader :isLoading="isLoadingTransaction" />
                      </td>
                    </tr>
                    <template
                      v-for="transaction in customertransactions"
                      :key="transaction.transactionId"
                    >
                      <tr>
                        <td class="sort-name">
                          TR-{{ transaction.transactionId }}
                        </td>
                        <td class="sort-city">
                          {{ transaction.transactionAmount }}
                        </td>
                        <td class="sort-type">{{ transaction.created_at }}</td>
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
import useCustomer from "../../../composables/useCustomer";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";
import PlanSelect from "../../../components/SelectBox/PlanSelect/PlanSelect.vue";
import AgentSelect from "../../../components/SelectBox/AgentSelect/AgentSelect.vue";
import useNavigation from "../../../composables/useNavigation";
import useTransaction from "../../../composables/useTransaction";
undefined;
undefined;
export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    LocationSelect,
    PlanSelect,
    AgentSelect,
  },
  props: {
    id: Number,
  },
  setup(props) {
    const { router, route } = useNavigation();

    const state = reactive({
      f_username: "",
      s_username: "",
      primary_phone: "",
      secondary_phone: "",
      location_id: 0,
      agent_id: 0,
    });

    const { customer, getCustomer, updateCustomer } = useCustomer();
    const {
      customertransactions,
      getSingleCustomerTransaction,
      isLoadingTransaction,
      customerTransactionsTotal,
    } = useTransaction();

    onMounted(() => {
      getCustomer(props.id);
      getSingleCustomerTransaction(props.id);
    });

    const handleSubmission = () => {
      updateCustomer(props.id)
        .then((e) => {
          if (e.status === 200) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: `Member Information updated`,
              showConfirmButton: false,
              timer: 1500,
            });

            router.push({ name: "all-customer" });
          }
        })
        .catch((e) => {
          if (e.response.status == 422) {
            if (e.response.data.errors.customer_id) {
              Swal.fire({
                position: "top",
                icon: "error",
                title: `${e.response.data.errors.customer_id}`,
                toast: true,
                showConfirmButton: false,
                timer: 1500,
              });
            }
          }
        });
    };

    return {
      ...toRefs(state),
      handleSubmission,
      customer,
      customertransactions,
      isLoadingTransaction,
      customerTransactionsTotal,
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
