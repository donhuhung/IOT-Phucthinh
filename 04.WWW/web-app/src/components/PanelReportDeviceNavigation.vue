<template>
  <div>

    <div class="tab-menu-report">
      <template v-for="r in ['sensor','motor', 'valve']">
        <v-btn :key="r" :to="{name: `report-${r}`, params: $route.params}">
          {{ r }}
        </v-btn>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  name: "PanelReportDeviceNavigation",
}
</script>

<style scoped>
.tab-menu-report{
  background-color: #f5f5f5;
}
.v-btn--is-elevated{
  box-shadow: none;
}
.v-btn--active{
  color:#1976d2;
}
</style>