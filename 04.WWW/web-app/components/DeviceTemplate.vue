<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      HA THANH WATER SUPPLY FACTORY, 30.000m3 Capacity
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & CONTROLLING DEVICES</p>
    <div class="mt-6"></div>
    <TableInformationDevice index="1"/>
    <div class="mt-6"></div>
    <TableInformationDevice title="PROCESS STATION" index="2"/>
    <div class="mt-6"></div>
    <TableInformationDevice title="CHEMICAL STATION" index="3"/>
  </div>
</template>

<script>
import TableInformationDevice from "./TableInformationDevice";
export default {
  name: "DeviceTemplate",
  components: {TableInformationDevice},
}
</script>

<style scoped>

</style>
