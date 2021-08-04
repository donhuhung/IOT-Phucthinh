<template>
<div>
  <ReportTemplate end-point="/api/v1/report/chemical" device-name="chemical"/>
</div>
</template>

<script>
import ReportTemplate from "../../../components/ReportTemplate";
export default {
  name: "chemical",
  components: {ReportTemplate}
}
</script>

<style scoped>

</style>
