<template>
  <select class="form-select required" v-model="value">
    <option id="0" value="0" :selected="true">Choose Scheme</option>
    <template v-for="scheme in schemes" :key="scheme.id">
      <option
        :id="scheme.id"
        :selected="scheme.id === value"
        v-bind:value="scheme.id"
      >
        {{ scheme.schemeName }}
      </option>
    </template>
  </select>
</template>

<script>
import { onMounted } from "vue";
import useScheme from "../../../composables/useScheme";

export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    const { schemes, getSchemes } = useScheme();

    onMounted(() => {
      getSchemes();
    });

    return { schemes };
  },
};
</script>

<style lang="scss" scoped>
</style>
