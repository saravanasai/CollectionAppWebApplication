<template>
  <div class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar-menu"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1
        class="
          navbar-brand navbar-brand-autodark
          d-none-navbar-horizontal
          pe-0 pe-md-3
        "
      >
        <router-link :to="{ name: 'home' }">
          <img
            :src="Logo"
            alt="Collection Manager"
            class="navbar-brand-image"
            width="110"
            height="32"
          />
        </router-link>
      </h1>
      <div class="navbar-nav flex-row order-md-last">
        <div class="d-none d-md-flex"></div>
        <!-- logout dropdown section -->
        <div class="nav-item dropdown">
          <a
            href="#"
            class="nav-link d-flex lh-1 text-reset p-0"
            data-bs-toggle="dropdown"
            aria-label="Open user menu"
          >
            <div class="d-none d-xl-block ps-2">
              <div>{{ userInfo.name }}</div>
              <div class="mt-1 small text-muted">{{ userInfo.email }}</div>
            </div>
          </a>
        </div>
        <!--end logout dropdown section -->
      </div>
      <!-- mobile view top menu section  -->
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div
          class="
            d-flex
            flex-column flex-md-row flex-fill
            align-items-stretch align-items-md-center
          "
        >
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'home' }">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
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
                    <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                  </svg>
                </span>
                <span class="nav-link-title"> Home </span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'about-us' }">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-dashboard"
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
                    <circle cx="12" cy="13" r="2"></circle>
                    <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                    <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                  </svg>
                </span>
                <span class="nav-link-title"> About Us </span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'dashboard' }">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-businessplan"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <desc>
                      Download more icon variants from
                      https://tabler-icons.io/i/businessplan
                    </desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <ellipse cx="16" cy="6" rx="5" ry="3"></ellipse>
                    <path
                      d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"
                    ></path>
                    <path
                      d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"
                    ></path>
                    <path
                      d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"
                    ></path>
                    <path
                      d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"
                    ></path>
                    <path d="M5 15v1m0 -8v1"></path>
                  </svg>
                </span>
                <span class="nav-link-title"> My-Dashboard </span>
              </router-link>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#navbar-third"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                role="button"
                aria-expanded="false"
              >
                <span class="nav-link-icon d-md-none d-lg-inline-block"
                  ><!-- Download SVG icon from http://tabler-icons.io/i/star -->
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
                    <path
                      d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                    ></path>
                  </svg>
                </span>
                <span class="nav-link-title"> Masters </span>
              </a>
              <div class="dropdown-menu">
                <router-link class="dropdown-item" to="">
                  Location Master
                </router-link>
                <router-link class="dropdown-item" to="">
                  Agent Master
                </router-link>
                <router-link class="dropdown-item" to="">
                  Scheme Master
                </router-link>
                <router-link class="dropdown-item" to="">
                  Plan Master
                </router-link>
              </div>
            </li>
            <template v-if="!authState">
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'login' }">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
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
                      <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                      <path
                        d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"
                      ></path>
                      <path
                        d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"
                      ></path>
                    </svg>
                  </span>
                  <span class="nav-link-title"> Login </span>
                </router-link>
              </li>
            </template>
            <template v-if="authState">
              <li class="nav-item">
                <a class="nav-link" @click="handleLogout">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
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
                      <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                      <path
                        d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"
                      ></path>
                      <path
                        d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"
                      ></path>
                    </svg>
                  </span>
                  <span class="nav-link-title"> Logout </span>
                </a>
              </li>
            </template>
          </ul>
        </div>
      </div>
      <!--end mobile view top menu section  -->
    </div>
  </div>
</template>

<script>
import { inject, onMounted, reactive, ref, toRefs } from "@vue/runtime-core";
import Swal from "sweetalert2";
import Logo from "../../assets/logo/logo.jpg";
import useAuth from "../../../composables/useAuth";
export default {
  components: {},
  setup() {
    // inject reactive value
    const { authState } = inject("store");
    const { logout, removeAuthToken, getUserInfo } = useAuth();

    const user = reactive({
      userInfo: {},
    });

    onMounted(() => {
      user.userInfo = getUserInfo() ? JSON.parse(getUserInfo()) : false;
    });

    const handleLogout = () => {
      let instance = Toast.open({
        message: "Loging out....",
        duration: 15000,
      });
      logout()
        .then((e) => {
          if (e.status == 204) {
            instance.dismiss();
            removeAuthToken();
            window.location.href = "/";
          }
        })
        .catch((e) => {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: `${e.message}`,
            toast: true,
            showConfirmButton: false,
            timer: 1500,
          });

          removeAuthToken();
          window.location.href = "/";
        });
    };

    return { Logo, authState, handleLogout, ...toRefs(user) };
  },
};
</script>

<style lang="scss" scoped>
</style>
