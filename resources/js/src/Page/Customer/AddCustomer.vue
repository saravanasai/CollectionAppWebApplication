<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>New Customer</template>
        <template v-slot:page-tittle>Add New Customer</template>
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
                 <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </p>
              <div class="card-header">
                <h3 class="card-title">ADD NEW MEMBER</h3>
              </div>
              <div class="card-body">
                <form  @submit.prevent="handleSubmission">
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">Member ID</label>
                        <div>
                          <input
                            v-model="customer_id"
                            type="number"
                            class="form-control"
                            placeholder="Enter Member ID"
                            required
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">First Name</label>
                        <div>
                          <input
                            v-model="f_username"
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
                            v-model="s_username"
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
                            v-model="primary_phone"
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
                            v-model="secondary_phone"
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
                          <LocationSelect  v-model="location_id"  :value="location_id" />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Select Plan</label>
                        <div>
                          <PlanSelect  v-model="plan_id" :value="plan_id" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Select Agent</label>
                        <div>
                          <AgentSelect  v-model="refered_agent_id" :value="refered_agent_id" />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Select Scheme</label>
                        <div>
                          <SchemeSelect  v-model="scheme_id" :value="scheme_id" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary float-end">
                      Create
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
import SchemeSelect from "../../../components/SelectBox/SchemeSelect/SchemeSelect.vue";
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
    SchemeSelect,
    BackButton
},
  setup() {
    const errors = ref([]);

    const { router, route } = useNavigation();

    const state = reactive({
      customer_id: "",
      f_username: "",
      s_username: "",
      primary_phone: "",
      secondary_phone: "",
      location_id: 0,
      plan_id: 0,
      refered_agent_id: 0,
      scheme_id: 0,
    });

    const { addCustomer } = useCustomer();

    const handleSubmission = () => {
      let data = new FormData();
      data.append("customer_id", state.customer_id);
      data.append("f_username", state.f_username);
      data.append("s_username", state.s_username);
      data.append("primary_phone", state.primary_phone);
      data.append("secondary_phone", state.secondary_phone);
      data.append("location_id", state.location_id);
      data.append("plan_id", state.plan_id);
      data.append("refered_agent_id", state.refered_agent_id);
      data.append("scheme_id", state.scheme_id);

      addCustomer(data)
        .then((e) => {
          if (e.status === 201) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: `New Member Added`,
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

    return { ...toRefs(state), errors, handleSubmission };
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
