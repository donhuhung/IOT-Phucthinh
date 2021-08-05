<template>
  <div>
    <PanelReportDeviceNavigation/>
    <router-view />
  </div>
</template>

<script>
import PanelReportDeviceNavigation from "../../../components/PanelReportDeviceNavigation";
export default {
  components: {PanelReportDeviceNavigation},
  created() {
    const { params } = this.$route
    if(this.$route.name === `report-device`) {
      this.$router.push({name: 'report-sensor', params})
    }
  }
}
</script>

<style scoped>

</style>
