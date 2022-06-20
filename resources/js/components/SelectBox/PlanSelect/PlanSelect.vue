<template>
  <select class="form-select required" v-model="value">
    <option id="0" value="0" :selected="true">Choose Plan</option>
    <template v-for="plan in plans" :key="plan.id">
      <option
        :id="plan.id"
        :selected="plan.id === value"
        v-bind:value="plan.id"
      >
        {{ plan.amount }}
      </option>
    </template>
  </select>
</template>

<script>
import { onMounted } from "vue";
import usePlan from "../../../composables/usePlan";

export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    const { plans, getPlan } = usePlan();

    onMounted(() => {
      getPlan();
    });

    return { plans };
  },
};
</script>

<style lang="scss" scoped>
</style>
