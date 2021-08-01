<template>
  <div>
    <ReportTemplate end-point="/api/v1/report/electrical"/>
  </div>
</template>

<script>

import ReportTemplate from "../../../components/ReportTemplate";

export default {
  name: "electrical",
  components: {ReportTemplate},
}
</script>

<style scoped>

</style>
