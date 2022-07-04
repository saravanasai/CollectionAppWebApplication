<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Agent</template>
        <template v-slot:page-tittle>Agent Details</template>
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
                <h3 class="card-title">AGENT DEATILS</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="handleSubmission">
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">Agent ID</label>
                        <div>
                          <input
                            v-model="agent.agentId"
                            type="text"
                            class="form-control"
                            placeholder="Enter Agent ID"
                            readonly
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required">Agent Name</label>
                        <div>
                          <input
                            v-model="agent.agentName"
                            type="Text"
                            class="form-control"
                            placeholder="Enter Agent Name"
                            required
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label required"
                          >Agent Phone Number</label
                        >
                        <div>
                          <input
                            v-model="agent.agentPhone"
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
                        <label class="form-label">Agent Location</label>
                        <div>
                          <LocationSelect
                            v-model="agent.agentLocationId"
                            :value="agent.agentLocationId"
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
import useAgent from "../../../composables/useAgent";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import LocationSelect from "../../../components/SelectBox/LocationSelect/LocationSelect.vue";
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
    BackButton,
  },
  props: {
    id: Number,
  },
  setup(props) {
    const { router, route } = useNavigation();

    const { agent,updateAgent,getAgent } = useAgent();

    onMounted(() => {
      getAgent(props.id);
    });

    const handleSubmission = () => {
      updateAgent(props.id)
        .then((e) => {
          if (e.status === 200) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: `Agent Information updated`,
              showConfirmButton: false,
              timer: 1500,
            });

            router.push({ name: "agents" });
          }
        })
        .catch((e) => {

        });
    };

    return { handleSubmission, agent };
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
