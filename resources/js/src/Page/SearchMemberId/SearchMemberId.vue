<template>
  <MainLayout>
    <template v-slot:top-section>
      <Tittle>
        <template v-slot:pre-tittle>Search By Member-ID</template>
        <template v-slot:page-tittle>Search By Member-ID</template>
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
          <div class="col-md-6 col-sm-3">
            <div class="m-3">
              <input
                type="text"
                v-model="memberId"
                class="form-control"
                placeholder="Member ID"
              />
            </div>
          </div>
          <div class="col-md-6 col-sm-3">
            <div class="m-3">
              <button
                type="button"
                @click="handleFind"
                class="btn btn-dark mx-1 float-end"
              >
                <template v-if="!isFinding"> Find </template>
                <template v-if="isFinding"> Finding... </template>
              </button>
            </div>
          </div>
        </div>
        <div class="card-header justify-content-center"></div>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import MainLayout from "../../layout/Main/Main.vue";
import Tittle from "../../layout/Tittle/Tittle.vue";
import Loader from "../../../components/Loader/Loader.vue";
import { onMounted, ref, toRefs, reactive } from "@vue/runtime-core";
import useNavigation from "../../../composables/useNavigation";
import CustomerCard from "../../../components/Widget/CustomerCard/CustomerCard.vue";
import BackButton from "../../../components/Buttons/BackButton/BackButton.vue";
import useCustomer from "../../../composables/useCustomer";
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
    const memberId = ref(null);
    const isFinding = ref(false);

    const { router } = useNavigation();

    const { getCustomerbyMemberId } = useCustomer();

    const handleFind = () => {
      isFinding.value = true;
      getCustomerbyMemberId(memberId.value)
        .then((e) => {
          if (e.status == 200) {
            router.push({
              name: "customer-pay",
              params: { id: e.data.data.id },
            });
          }
        })
        .catch((e) => {
          isFinding.value = false;
          if (e.response.status == 404) {
            Toast.open({
              type: "error",
              message: "Member Not Found",
              duration: 1500,
            });
          }
        });
    };

    return { memberId, isFinding, handleFind };
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
