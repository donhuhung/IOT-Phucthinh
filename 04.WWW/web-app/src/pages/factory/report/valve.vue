<template>
  <div>
    <PanelReportDeviceNavigation/>
    <ReportTemplateDevice end-point="/api/v1/report/valve" device-name="valve" name-report="Valve"/>
  </div>
</template>

<script>

import ReportTemplateDevice from "../../../components/ReportTemplateDevice";
import PanelReportDeviceNavigation from "../../../components/PanelReportDeviceNavigation";

export default {
  name: "valve",
  components: {ReportTemplateDevice, PanelReportDeviceNavigation},
  data() {
    return {}
  },
}
</script>

<style scoped>

</style>
