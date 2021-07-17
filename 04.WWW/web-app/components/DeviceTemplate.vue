<template>
  <div class="space-y-2">
    <v-app-bar height="40px" flat>
      <v-tabs v-model="panel">
        <template v-for="(tab, index) in items">
          <v-tab :key="index">
            <div class="text-xs df_text">
              {{ tab.title }}
            </div>
          </v-tab>
        </template>
      </v-tabs>
    </v-app-bar>
    <v-divider/>
    <v-app-bar height="40px" flat>
      <v-tabs v-model="child">
        <template v-for="child in children">
          <v-tab :key="child">
            <div class="text-xs df_text">
              {{ child }}
            </div>
          </v-tab>
        </template>
      </v-tabs>
    </v-app-bar>
    <template v-if="dataDevice.length">
      <GridOfDevice :dataDevice="dataDevice"/>
    </template>
    <template v-else>
      <v-card flat color="blue-grey lighten-5">
        <v-card-text class="text-center">
          <div class="flex justify-center items-center space-x-2">
            <div>
              <v-icon>mdi-folder-open</v-icon>
            </div>
            <div>
              Data not found
            </div>
          </div>
        </v-card-text>
      </v-card>
    </template>
  </div>
</template>

<script>
import GridOfDevice from "./GridOfDevice";
import {getListDevice} from "@/api/app"
import GridTable from "./GridTable";

export default {
  name: "DeviceTemplate",
  components: {GridTable, GridOfDevice},
  data() {
    return {
      panel: 0,
      items: [],
      children: ['motor', 'valve'],
      child: 0,
    }
  },
  mounted() {
    this.listDevice()
  },
  computed: {
    dataDevice() {
      const {panel, items, child} = this
      const isMotor = child === 0
      // todo: handle items with type device: valve || motor
      const itemsMotor = items[panel] ? items[panel].data : []
      const itemsValve = []
      return isMotor ? itemsMotor : itemsValve
    }
  },
  methods: {
    getListDevice,
    async listDevice() {
      let factory_id = this.$route.params.factory;
      const res = await this.getListDevice(factory_id)
      this.items = res.data
    }
  }
}
</script>

<style scoped>

</style>
