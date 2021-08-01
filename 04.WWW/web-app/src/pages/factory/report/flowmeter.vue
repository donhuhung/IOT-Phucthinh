<template>
<div>
  <ReportTemplate end-point="/api/v1/report/flowmeter" />
</div>
</template>

<script>
import ReportTemplate from "../../../components/ReportTemplate";
export default {
  name: "flowmeter",
  components: {ReportTemplate}
}
</script>

<style scoped>

</style>
