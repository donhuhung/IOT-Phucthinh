<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      HA THANH WATER SUPPLY FACTORY, 30.000m3 Capacity
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & CONTROLLING DEVICES</p>
    <div class="mt-6"></div>
    <TableInformationDevice/>
    <div class="mt-6"></div>
    <TableInformationDevice title="PROCESS STATION"/>
    <div class="mt-6"></div>
    <TableInformationDevice title="CHEMICAL STATION"/>
  </div>
</template>

<script>
import TableInformationDevice from "../components/TableInformationDevice";
export default {
  components: {TableInformationDevice},
  layout: "app"
}
</script>

<style scoped>

</style>
