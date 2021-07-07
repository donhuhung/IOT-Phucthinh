<template>
  <div>
    <h3 class="text-sm text-h6 mb-2 capitalize">
      Ha Thanh Water Supply Factory, 30.000m3 Capacity
    </h3>
    <p>MONITORING & CONTROLLING DEVICES</p>
    <div class="mt-6"></div>
    <v-expansion-panels multiple>
      <v-expansion-panel
          v-for="(text,i) in ['RAW PUMP STATION', 'PROCESS STATION', 'CHEMICAL STATION']"
          :key="i"
      >
        <v-expansion-panel-header>
          {{ text }}
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-divider></v-divider>
          <GridOfDevice />
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>

<script>
import GridOfDevice from "./GridOfDevice";
export default {
  name: "DeviceTemplate",
  components: {GridOfDevice},
}
</script>

<style scoped>

</style>
