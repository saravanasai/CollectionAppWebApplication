<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>All Members</template>
        <template v-slot:page-tittle>All Members</template>
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
      <div class="card p-md-5 m-sm-2">
        <div class="row">
          <div class="col-md-12 col-sm-3">
            <div class="m-3">
              <input
                type="text"
                v-model="searchKey"
                v-on:keyup="() => handleSearch()"
                class="form-control"
                placeholder="Search…"
              />
            </div>
          </div>
        </div>
        <div class="card-header justify-content-center"></div>
        <div
          class="list-group list-group-flush overflow-auto"
          style="max-height: 35rem"
        >
          <Loader :isLoading="isLoadingCustomer" />

          <CustomerCard :data="customers" v-if="!isLoadingCustomer" />
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
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
undefined;
undefined;
export default {
  components: {
    MainLayout,
    Tittle,
    Loader,
    CustomerCard,
    BackButton,
  },
  setup() {
    const searchKey = ref("");
    const debounce = ref(null);

    const { router, route } = useNavigation();

    const { customers, getCustomers, isLoadingCustomer } = useCustomer();

    onMounted(() => {
      getCustomers(searchKey.value);
    });

    const handleSearch = () => {
      clearTimeout(debounce.value);
      debounce.value = setTimeout(() => {
        getCustomers(searchKey.value);
      }, 600);
    };

    return { customers, searchKey, handleSearch, isLoadingCustomer };
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
