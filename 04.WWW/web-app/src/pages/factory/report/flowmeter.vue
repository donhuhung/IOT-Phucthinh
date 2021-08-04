<template>
<div>
  <ReportTemplate end-point="/api/v1/report/flowmeter" device-name="flowmeter"/>
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
