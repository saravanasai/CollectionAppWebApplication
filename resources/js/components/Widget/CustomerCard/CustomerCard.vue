<template>
  <template v-for="customer in data" :key="customer.id">
    <div class="list-group-item">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <div>
              Name:
              <strong
                >{{ customer.firstName }} {{ customer.secondName }}</strong
              >
            </div>
            <div>
              Member ID: <strong>{{ customer.customerId }}</strong>
            </div>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/book -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-device-mobile"
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
              <rect x="6" y="3" width="12" height="18" rx="2"></rect>
              <line x1="11" y1="4" x2="13" y2="4"></line>
              <line x1="12" y1="17" x2="12" y2="17.01"></line>
            </svg>
            Phone: <strong>{{ customer.primaryPhone }}</strong>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/briefcase -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-user-check"
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
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
              <path d="M16 11l2 2l4 -4"></path>
            </svg>
            Agent: <strong>{{ customer.agent?.agentName }}</strong
            >-{{ customer.agent?.agentId }}
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon me-2 text-muted"
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
              <circle cx="12" cy="11" r="3"></circle>
              <path
                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"
              ></path>
            </svg>
            Location:
            <strong> {{ customer.location.locationName }}</strong>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon me-2 text-muted"
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
              <rect x="4" y="5" width="16" height="16" rx="2"></rect>
              <line x1="16" y1="3" x2="16" y2="7"></line>
              <line x1="8" y1="3" x2="8" y2="7"></line>
              <line x1="4" y1="11" x2="20" y2="11"></line>
              <line x1="11" y1="15" x2="12" y2="15"></line>
              <line x1="12" y1="15" x2="12" y2="18"></line>
            </svg>
            Join Date: <strong>{{ customer.created_at }}</strong>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-list-details"
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
              <path d="M13 5h8"></path>
              <path d="M13 9h5"></path>
              <path d="M13 15h8"></path>
              <path d="M13 19h5"></path>
              <rect x="3" y="4" width="6" height="6" rx="1"></rect>
              <rect x="3" y="14" width="6" height="6" rx="1"></rect>
            </svg>
            Balance Due: Rs/-
            <strong>{{ customer.collection?.collection_balance_due }}</strong>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-list-details"
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
              <path d="M13 5h8"></path>
              <path d="M13 9h5"></path>
              <path d="M13 15h8"></path>
              <path d="M13 19h5"></path>
              <rect x="3" y="4" width="6" height="6" rx="1"></rect>
              <rect x="3" y="14" width="6" height="6" rx="1"></rect>
            </svg>
            Complement 1 :
            <span
              :class="
                customer.complementOne
                  ? 'badge bg-green-lt'
                  : 'badge bg-danger-lt'
              "
            >
              <template v-if="customer.complementOne"> Yes </template>
              <template v-if="!customer.complementOne"> No </template>
            </span>
          </div>
          <div class="mb-2">
            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-list-details"
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
              <path d="M13 5h8"></path>
              <path d="M13 9h5"></path>
              <path d="M13 15h8"></path>
              <path d="M13 19h5"></path>
              <rect x="3" y="4" width="6" height="6" rx="1"></rect>
              <rect x="3" y="14" width="6" height="6" rx="1"></rect>
            </svg>
            Complement 2 :
            <span
              :class="
                customer.complementTwo
                  ? 'badge bg-green-lt'
                  : 'badge bg-danger-lt'
              "
            >
              <template v-if="customer.complementTwo"> Yes </template>
              <template v-if="!customer.complementTwo"> No </template>
            </span>
          </div>
          <div>
            <!-- Download SVG icon from http://tabler-icons.io/i/clock -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon me-2 text-muted"
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
              <circle cx="12" cy="12" r="9"></circle>
              <polyline points="12 7 12 12 15 15"></polyline>
            </svg>
            Plan: Rs/-<strong>{{ customer.plan.amount }}</strong>
          </div>
          <div class="mt-2 float-end">
            <router-link
              v-show="showComplementBtn"
              :to="{ name: 'complement-edit', params: { id: customer.id } }"
              class="btn btn-success ms-auto mx-1"
              >Complement</router-link
            >
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex">
            <router-link
              v-show="showEditBtn"
              :to="{ name: 'customer-edit', params: { id: customer.id } }"
              class="btn btn-link"
              >Edit</router-link
            >
            <div class="d-flex justify-content-around">
              <router-link
                :to="{
                  name: 'customer-transaction',
                  params: { id: customer.id },
                }"
                class="btn btn-primary ms-auto mx-1"
                >Transaction</router-link
              >
              <router-link
                v-show="showPayBtn"
                :to="{ name: 'customer-pay', params: { id: customer.id } }"
                class="btn btn-dark ms-auto mx-1"
                >Pay Due</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
</template>



<script>
export default {
  props: {
    data: Object,
    showEditBtn: {
      type: Boolean,
      default: true,
    },
    showPayBtn: {
      type: Boolean,
      default: true,
    },
    showComplementBtn: {
      type: Boolean,
      default: true,
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
