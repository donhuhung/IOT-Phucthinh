<template>
  <div>
    <v-app-bar height="40px" flat>
      <v-tabs v-model="activetab">
        <template v-for="(tab, index) in items">
          <v-tab :key="index">
            <div class="text-xs df_text">
              {{ tab.deviceName }}
            </div>
          </v-tab>
        </template>
      </v-tabs>
    </v-app-bar>
    <div class="">
      <template v-if="items[activetab]">
          <div class="mx-n2 py-2">
            <div class="d-flex flex-wrap">
              <template v-for="(data, index) in items[activetab]">
                <div :key="index" class="row-item-table px-2 py-2">
                  <ReportTemplateDevice :end-point="data.endPoint" :device-name="data.deviceName"/>
                </div>
              </template>
            </div>
          </div>
      </template>
    </div>
  </div>
</template>

<script>

import ReportTemplateDevice from "../../../components/ReportTemplateDevice";

export default {
  name: "device",
  components: {ReportTemplateDevice},
  data() {
    return {
      activetab: 0,
      items:[
        {
          title: 'Sensor',
          endPoint: '/api/v1/report/sensor',
          deviceName: 'sensor'
        },
        {
          title: 'Motor',
          endPoint: '/api/v1/report/motor',
          deviceName: 'motor'
        },
        {
          title: 'Valve',
          endPoint: '/api/v1/report/valve',
          deviceName: 'valve'
        },
      ]
    }
  },
}
</script>

<style scoped>

</style>
