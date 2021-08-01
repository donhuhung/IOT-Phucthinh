<template>
  <div>
    <template v-if="getting">
      <v-skeleton-loader type="table" width="690px"/>
    </template>
    <StatisticElectricalTemplate v-else :row="electrical" />
  </div>
</template>

<script>
import StatisticElectricalTemplate from "../../../components/StatisticElectricalTemplate"
import https from "../../../plugins/https";

export default {
  components: {StatisticElectricalTemplate},
  data() {
    return {
      electrical: {},
      getting: false,
    }
  },
  async mounted() {
    try {
      this.getting = true
      const res1 = await https.post('/api/v1/statistic/electrical')
      this.electrical = res1.data.data
    }finally {
      this.getting = false
    }
    // const res2 = await https.post('/api/v1/statistic/chemical')
    // this.chemical = res2.data.data
    // const res3 = await https.post('/api/v1/statistic/flowmeter')
    // this.flowmeter = res3.data.data
  }
}
</script>

<style scoped>

</style>
