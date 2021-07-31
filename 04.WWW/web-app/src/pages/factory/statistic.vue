<template>
  <div>
    <StatisticElectricalTemplate :row="electrical"/>
  </div>
</template>

<script>
import https from '../../plugins/https'
import StatisticElectricalTemplate from "../../components/StatisticElectricalTemplate";
export default {
  components: {StatisticElectricalTemplate},
  data() {
    return {
      electrical: {},
      chemical: {},
      flowmeter: {},
    }
  },
  computed: {
    ks() {
      return ['thong_so_dien', 'bieu_gia_dien', 'chi_phi_dien', 'dien_nang_tieu_thu']
    },
    xs() {
      return  [
          ['bieu_gia_dien', ['binh_thuong', 'cao_diem', 'thap_diem']],
          ['thong_so_dien', ['binh_thuong', 'cao_diem', 'thap_diem']],
      ]
    }
  },
  async mounted() {
    const res1 = await https.post('/api/v1/statistic/electrical')
    this.electrical = res1.data.data
    const res2 = await https.post('/api/v1/statistic/chemical')
    this.chemical = res2.data.data
    const res3 = await https.post('/api/v1/statistic/flowmeter')
    this.flowmeter = res3.data.data
  }
}
</script>

<style scoped lang="scss">

</style>
