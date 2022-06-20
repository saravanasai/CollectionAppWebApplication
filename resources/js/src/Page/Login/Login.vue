<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Home</template>
        <template v-slot:page-tittle> Collection Manager </template>
        <template v-slot:right-side-content>
          <div class="btn-list">
            <span class="d-none d-sm-inline">
              <a href="#" class="btn btn-dark"> New Agent </a>
            </span>
            <a
              href="#"
              class="btn btn-primary d-none d-sm-inline-block"
              data-bs-toggle="modal"
              data-bs-target="#modal-report"
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
              Add Members
            </a>
            <a
              href="#"
              class="btn btn-primary d-sm-none btn-icon"
              data-bs-toggle="modal"
              data-bs-target="#modal-report"
              aria-label="Create new report"
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
            </a>
          </div>
        </template>
      </Tittle>
    </template>
    <template v-slot:content>
      <div class="row mt-3">
        <div class="col-md-6 offset-md-3 col-sm-12">
          <div class="card mb-5">
            <form class="card" action="." method="get" autocomplete="off">
              <div class="card-body">
                <h2 class="card-title text-center mb-4">
                  Login to your account
                </h2>
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input
                    v-model="email"
                    type="email"
                    class="form-control"
                    placeholder="Enter email"
                    autocomplete="off"
                  />
                </div>
                <div class="mb-2">
                  <label class="form-label">
                    Password
                    <!-- <span class="form-label-description">
                <a href="./forgot-password.html">I forgot password</a>
              </span> -->
                  </label>
                  <div class="input-group input-group-flat">
                    <input
                      v-bind:type="isVisible ? 'text' : 'password'"
                      v-model="password"
                      class="form-control"
                      placeholder="Password"
                      autocomplete="off"
                    />
                    <span class="input-group-text">
                      <a
                        @click="isVisible = !isVisible"
                        href="#"
                        class="link-secondary"
                        title=""
                        data-bs-toggle="tooltip"
                        data-bs-original-title="Show password"
                        ><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
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
                          <path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"
                          ></path>
                          <circle cx="12" cy="12" r="2"></circle>
                          <path
                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"
                          ></path>
                        </svg>
                      </a>
                    </span>
                  </div>
                </div>
                <div class="form-footer">
                  <button
                    type="button"
                    @click="handleLogin"
                    class="btn btn-primary w-100"
                  >
                    Log in
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import { reactive, toRefs } from "@vue/reactivity";
import useAuth from "../../../composables/useAuth";
import { inject } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import Tittle from "../../layout/Tittle/Tittle.vue";
import MainLayout from "../../layout/Main/Main.vue";
export default {
  setup() {
    // inject reactive value
    const { updateAuthState } = inject("store");
    const state = reactive({
      email: "admin@exciteon.com",
      password: "1234",
      isVisible: false,
    });
    const { login, setAuthToken } = useAuth();
    const { router, route } = useNavigation();
    const handleLogin = () => {
      let data = {
        email: state.email,
        password: state.password,
      };
      let instance = Toast.open({
        message: "Authenticating....",
        duration: 15000,
      });
      login(data)
        .then((e) => {
          if (e.status == 200) {
            instance.dismiss();
            setAuthToken(e.data.token, e.data.data);
            updateAuthState(true);
            window.location.href = route.query.redirect
              ? route.query.redirect
              : "/";
          }
        })
        .catch((e) => {
          instance.dismiss();
          Swal.fire({
            position: "top",
            icon: "error",
            title: `${e.message}`,
            toast: true,
            showConfirmButton: false,
            timer: 1500,
          });
        });
    };
    return { ...toRefs(state), handleLogin };
  },
  components: { Tittle, MainLayout },
};
</script>

<style>
</style>
