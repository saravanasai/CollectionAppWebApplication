<template>
  <div class="card">
    <div class="card-body">
      <div  class="table-responsive">
        <table class="table" :id="tableId">
          <thead>
            <tr>
              <template v-for="(item,i) in headers" :key="i">
                <th>{{item}}</th>
              </template>
            </tr>
          </thead>
          <tbody class="table-tbody">
            <template v-for="(item,i)  in data" :key="item.id">
            <tr>
              <td class="sort-name">{{++i}}</td>
              <td class="sort-city">{{item.customerId}}</td>
              <td class="sort-city">{{item.firstName}}</td>
              <td class="sort-city">{{item.secondName}}</td>
              <td class="sort-city">{{item.primaryPhone}}</td>
              <td class="sort-city">{{item.plan?.amount}}</td>
              <td class="sort-city">{{item.location?.locationName}}</td>
              <td class="sort-city">{{item.agent?.agentName+'-'+item.agent?.agentId}}</td>
              <td class="sort-city">{{item.collection?.collection_total_due}}</td>
              <td class="sort-city">{{item.collection?.collection_balance_due}}</td>
            </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    headers: {
      default: ['sno','default Name','default Action'],
      type: Array,
    },
    data: {
      default: {},
      type: Object,
    },
    tableId: {
      default: 'default-table',
      type: String,
    },

  },
  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
</style>
