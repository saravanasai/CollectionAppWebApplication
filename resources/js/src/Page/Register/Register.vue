<template>
  <div class="page page-center">
    <div class="container-tight">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"></a>
      </div>
      <form class="card card-md" action="." method="get">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Create new account</h2>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input
              v-model="username"
              type="text"
              class="form-control"
              placeholder="Enter name"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input
              v-model="email"
              type="email"
              class="form-control"
              placeholder="Enter email"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group input-group-flat">
              <input
                v-model="password"
                :type="isVisible ? 'text' : 'password'"
                class="form-control"
                placeholder="Password"
                autocomplete="off"
              />
              <span class="input-group-text">
                <a
                  @click="isVisible = !isVisible"
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
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
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
              Create new account
            </button>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        Already have account?
        <router-link :to="{ name: 'login' }">Log in</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, toRefs } from "@vue/reactivity";
import useAuth from "../../../composables/useAuth";
import useNavigation from "../../../composables/useNavigation";
import { inject } from "@vue/runtime-core";
export default {
  setup() {
    const state = reactive({
      username: "",
      email: "",
      password: "",
      isVisible: false,
    });

    // inject reactive value
    const { authState, updateAuthState } = inject("store");
    const { router, route } = useNavigation();

    let { registeration, setAuthToken } = useAuth();

    const handleLogin = () => {
      let data = {
        name: state.username,
        email: state.email,
        password: state.password,
      };

      registeration(data)
        .then((e) => {
          if (e.status == 200) {
            setAuthToken(e.data.token,e.data.user);
            updateAuthState(true);
            Swal.fire({
            position: "top-end",
            icon: "success",
            title: 'You have Registered',
            toast:true,
            showConfirmButton: false,
            timer: 1500,
          }).then(e=>{
              window.location.href= route.query.redirect ? route.query.redirect : '/'
          })

          }
        })
        .catch((e) => {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: `${e.message}`,
            toast:true,
            showConfirmButton: false,
            timer: 1500,
          });
        });
    };



    return { ...toRefs(state), handleLogin, authState };
  },
};
</script>

<style>
</style>
