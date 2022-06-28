<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Customer</template>
        <template v-slot:page-tittle>Customer Details</template>
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
          <div class="col-md-10 offset-md-1 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">MEMBER DEATILS</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="handleSubmission">
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">Member ID</label>
                        <div>
                          <input
                            v-model="customer.customerId"
                            type="number"
                            class="form-control"
                            placeholder="Enter Member ID"
                            readonly
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">First Name</label>
                        <div>
                          <input
                            v-model="customer.firstName"
                            type="Text"
                            class="form-control"
                            placeholder="Enter First Name"
                            required
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group mb-3">
                        <label class="form-label">Last Name</label>
                        <div>
                          <input
                            v-model="customer.secondName"
                            type="Text"
                            class="form-control"
                            placeholder="Enter First Name"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required"
                          >P-Phone Number</label
                        >
                        <div>
                          <input
                            v-model="customer.primaryPhone"
                            type="=tel"
                            class="form-control"
                            maxlength="10"
                            placeholder="Enter Phone Number"
                            required
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">S-Phone Number</label>
                        <div>
                          <input
                            v-model="customer.secondaryPhone"
                            type="tel"
                            maxlength="10"
                            class="form-control"
                            placeholder="Enter Phone Number"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Select Location</label>
                        <div>
                          <LocationSelect
                            v-model="customer.locationId"
                            :value="customer.locationId"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Select Agent</label>
                        <div>
                          <AgentSelect
                            v-model="customer.agentId"
                            :value="customer.agentId"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary float-end">
                      Update
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
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";
import PlanSelect from "../../../components/SelectBox/PlanSelect/PlanSelect.vue";
import AgentSelect from "../../../components/SelectBox/AgentSelect/AgentSelect.vue";
import useNavigation from "../../../composables/useNavigation";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
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
    BackButton
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

    onMounted(() => {
      getCustomer(props.id);
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

    return { ...toRefs(state), handleSubmission, customer };
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
