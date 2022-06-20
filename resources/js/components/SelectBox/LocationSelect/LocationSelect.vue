<template>
  <select class="form-select required" v-model="value">
    <option id="0" value="0" :selected="true">Choose Location</option>
    <template v-for="location in locations" :key="location.id">
      <span>{{ value }}</span>
      <option
        :id="location.id"
        :selected="location.id === value"
        v-bind:value="location.id"
      >
        {{ location.locationName }} - {{ location.locationId }}
      </option>
    </template>
  </select>
</template>

<script>
import { onMounted } from "vue";
import useLocation from "../../../composables/useLocation";

export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    const { locations, getLocations, isLoadingLocation } = useLocation();

    onMounted(() => {
      getLocations();
    });

    return { locations, isLoadingLocation };
  },
};
</script>

<style lang="scss" scoped>
</style>
