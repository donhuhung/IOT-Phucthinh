<template>
  <div>electrical</div>
</template>

<script>
import https from "../../../plugins/https";

export default {
  name: "electrical",
  async mounted() {
    const res = await https.post('/api/v1/report/electrical', {
      factory_id: 1,
      from_date: '01-04-2021',
      to_date: '28-04-2021'
    })
    console.error(res)
  }
}
</script>

<style scoped>

</style>
