<template>
  <select class="form-select required" v-model="value">
    <option id="0" value="0" :selected="true">Choose Complement</option>
    <template v-for="complement in complementOptions" :key="complement.id">
      <option
        :id="complement.id"
        :selected="complement.id === value"
        v-bind:value="complement.id"
      >
        {{ complement.option }}
      </option>
    </template>
  </select>
</template>

<script>
export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    const complementOptions = [
      { id: 1, value: 1, option: "Complement-1" },
      { id: 2, value: 2, option: "Complement-2" },
      { id: 3, value: 3, option: "Both 1 & 2" },
      { id: 4, value: 4, option: "Not Both 1 & 2" },
    ];

    return { complementOptions };
  },
};
</script>

<style lang="scss" scoped>
</style>
