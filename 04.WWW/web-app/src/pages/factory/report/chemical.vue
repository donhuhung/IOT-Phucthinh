<template>
<div>
  <ReportTemplate end-point="/api/v1/report/chemical" :label-select="labelSelect" :items-select="itemsSelect" device-name="chemical"/>
</div>
</template>

<script>
import ReportTemplate from "../../../components/ReportTemplate";
export default {
  name: "chemical",
  components: {ReportTemplate},
  data() {
    return {
      labelSelect:'Select Chemical',
      itemsSelect: [
        {
          'id': 1,
          'name': 'Vôi'
        },
        {
          'id': 2,
          'name': 'PAC'
        },
        {
          'id': 3,
          'name': 'Polyme'
        },
        {
          'id': 4,
          'name': 'Clo'
        },
        {
          'id': 5,
          'name': 'Khác'
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>
