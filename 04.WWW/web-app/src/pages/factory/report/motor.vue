<template>
  <div>
    <PanelReportDeviceNavigation/>
    <ReportTemplateDevice end-point="/api/v1/report/motor" device-name="motor" name-report="Motor"/>
  </div>
</template>

<script>

import ReportTemplateDevice from "../../../components/ReportTemplateDevice";
import PanelReportDeviceNavigation from "../../../components/PanelReportDeviceNavigation";

export default {
  name: "motor",
  components: {ReportTemplateDevice, PanelReportDeviceNavigation},
  data() {
    return {}
  },
}
</script>

<style scoped>

</style>
