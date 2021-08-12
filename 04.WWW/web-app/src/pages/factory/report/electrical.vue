<template>
  <div>
    <ReportTemplate end-point="/api/v1/report/electrical" :label-select="labelSelect" :items-select="itemsSelect" device-name="electrical"/>
  </div>
</template>

<script>

import ReportTemplate from "../../../components/ReportTemplate";

export default {
  name: "electrical",
  components: {ReportTemplate},
  data() {
    return {
      labelSelect:'Select Station',
      itemsSelect: [
        {
          'id': 1,
          'name': 'Trạm 1'
        },
        {
          'id': 2,
          'name': 'Trạm 2'
        },
        {
          'id': 3,
          'name': 'Trạm 3'
        },
        {
          'id': 4,
          'name': 'Trạm 4'
        },
        {
          'id': 5,
          'name': 'Trạm 5'
        },
        {
          'id': 6,
          'name': 'Trạm 6'
        },
        {
          'id': 7,
          'name': 'Trạm 7'
        },
        {
          'id': 8,
          'name': 'Trạm 8'
        },
        {
          'id': 9,
          'name': 'Trạm 9'
        },
        {
          'id': 10,
          'name': 'Trạm 10'
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>
