<template>
<div>
  <ReportTemplate end-point="/api/v1/report/flowmeter" :label-select="labelSelect" :items-select="itemsSelect" device-name="flowmeter"/>
</div>
</template>

<script>
import ReportTemplate from "../../../components/ReportTemplate";
export default {
  name: "flowmeter",
  components: {ReportTemplate},
  data() {
    return {
      labelSelect:'Select Flowmeter',
      itemsSelect: [
        {
          'id': 1,
          'name': 'Lưu lượng đầu vào'
        },
        {
          'id': 2,
          'name': 'Lưu lượng hao phí'
        },
        {
          'id': 3,
          'name': 'Lưu lượng bán ra'
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>
