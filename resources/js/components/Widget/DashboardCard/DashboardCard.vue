
<template>
  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div :class="`card-status-top bg-${BarColor ?? 'danger'}`"></div>
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">{{ Tittle ?? "Sample Tittle" }}</div>
        </div>
        <div class="h1 mb-3">{{ Total ?? 0 }}</div>

        <div class="d-flex mb-2">
          <div>{{ SubTittle ?? "Sample Sub Tittle" }}</div>

          <div class="ms-auto">
            <span class="text-green d-inline-flex align-items-center lh-1">
              <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon ms-1"
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
                <polyline points="3 17 9 11 13 15 21 7"></polyline>
                <polyline points="14 7 21 7 21 14"></polyline>
              </svg>
            </span>
          </div>
        </div>
        <router-link
          :to="{ name: `${To}` }"
          :class="`btn btn-ghost-${BarColor} w-100`"
        >
          {{ BtnText ?? "sample text" }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    Tittle: String,
    SubTittle: String,
    BarColor: String,
    Total: Number,
    To: {
      default: "home",
      type: String,
    },
    BtnText: String,
  },
  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
</style>
