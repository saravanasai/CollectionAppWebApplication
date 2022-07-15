<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Pay Due</template>
        <template v-slot:page-tittle>Pay Due</template>
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
      <div class="card p-md-5">
        <div class="row">
          <div class="col-md-7">
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
                <div class="h5 my-1">
                  <span
                    >Complement 1 :
                    <span
                      :class="
                        Number(customer.complementOne)
                          ? 'badge bg-green-lt'
                          : 'badge bg-danger-lt'
                      "
                    >
                      {{ Number(customer.complementOne) == 1 ? "Yes" : "No" }}
                    </span>
                  </span>
                </div>
                <div class="h5 my-1">
                  <span
                    >Complement 2 :
                    <span
                      :class="
                        Number(customer.complementTwo)
                          ? 'badge bg-green-lt'
                          : 'badge bg-danger-lt'
                      "
                    >
                      {{ Number(customer.complementTwo) == 1 ? "Yes" : "No" }}
                    </span>
                  </span>
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
          <div class="col-md-5">
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
        </div>
        <div class="row mt-3">
          <div class="col-md-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payment Section</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="handlePayment">
                  <div class="mb-3">
                    <label class="form-label required">Amount</label>
                    <input
                      v-model="amount"
                      type="number"
                      max="10000"
                      class="form-control"
                      name="example-required-input"
                      placeholder="Amount"
                      required
                    />
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary float-end">
                      Pay
                    </button>
                  </div>
                </form>
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
import useNavigation from "../../../composables/useNavigation";
import usePayment from "../../../composables/usePayment";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
undefined;
undefined;
export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    BackButton,
  },
  props: {
    id: String,
  },
  setup(props) {
    const { router, route } = useNavigation();

    const { customer, getCustomer } = useCustomer();
    const { pay, amount } = usePayment();

    onMounted(() => {
      getCustomer(props.id);
    });

    const handlePayment = () => {
      pay(props.id)
        .then((e) => {
          if (e.status === 200) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: `Payment Done`,
              showConfirmButton: false,
              timer: 1500,
            });

            router.push({ name: "all-customer" });
          }
        })
        .catch((e) => {
          if (e.response.status == 422) {
            if (e.response.data.message) {
              Swal.fire({
                position: "top",
                icon: "error",
                title: `${e.response.data.message}`,
                toast: true,
                showConfirmButton: false,
                timer: 1500,
              });
            }
          }
        });
    };

    return { handlePayment, customer, amount };
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
