<template>
  <div>
    <PanelReportDeviceNavigation/>
    <ReportTemplateDevice end-point="/api/v1/report/sensor" device-name="sensor" name-report="Sensor"/>
  </div>
</template>

<script>

import ReportTemplateDevice from "../../../components/ReportTemplateDevice";
import PanelReportDeviceNavigation from "../../../components/PanelReportDeviceNavigation";

export default {
  name: "sensor",
  components: {ReportTemplateDevice, PanelReportDeviceNavigation},
  data() {
    return {}
  },
}
</script>

<style scoped>

</style>
