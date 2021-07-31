<template>
  <div>
    Thống kê
  </div>
</template>

<script>
import https from '../../plugins/https'
export default {
  async mounted() {
    const res1 = await https.post('/api/v1/statistic/electrical')
    console.error(res1)
    const res2 = await https.post('/api/v1/statistic/chemical')
    console.error(res2)
    const res3 = await https.post('/api/v1/statistic/flowmeter')
    console.error(res3)

  }
}
</script>

<style scoped>

</style>
