<template>
  <select class="form-select required" v-model="value">
    <option id="0" value="0" :selected="true">Choose Agent</option>
    <template v-for="agent in agents" :key="agent.id">
      <option
        :id="agent.id"
        :selected="agent.id === value"
        v-bind:value="agent.id"
      >
        {{ agent.agentName }} - {{agent.agentId}}
      </option>
    </template>
  </select>
</template>

<script>
import { onMounted } from "vue";
import useAgent from "../../../composables/useAgent";

export default {
  props: {
    value: {
      default: 0,
      type: Number,
    },
  },
  setup() {
    const { agents, getAgents } = useAgent();

    onMounted(() => {
      getAgents();
    });

    return { agents };
  },
};
</script>

<style lang="scss" scoped>
</style>
