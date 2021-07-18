<template>
  <div class="space-y-2">
    <v-app-bar height="40px" flat>
      <v-tabs v-model="panel">
        <template v-for="(tab, index) in itemMotors">
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
      <GridOfDevice :data-device="dataDevice" :is-valve="isValve"/>
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
import {getListMotor,getListValve} from "@/api/app"
import GridTable from "./GridTable";

export default {
  name: "DeviceTemplate",
  components: {GridTable, GridOfDevice},
  data() {
    return {
      panel: 0,
      itemMotors: [],
      itemValves: [],
      children: ['motor', 'valve'],
      child: 0,
    }
  },
  mounted() {
    this.listMotor()
    this.listValve()
  },
  computed: {
    dataDevice() {
      const {panel, itemMotors, itemValves, isValve} = this
      // todo: handle items with type device: valve || motor
      const itemsMotor = itemMotors[panel] ? itemMotors[panel].data : []
      const itemsValve = itemValves[panel] ? itemValves[panel].data : []
      return isValve ? itemsValve : itemsMotor
    },
    factoryId() {
      return this.$route.params.factory
    },
    isValve() {
      return this.child === 1
    }
  },
  methods: {
    async listMotor() {
      const res = await getListMotor(this.factoryId)
      this.itemMotors = res.data.data
    },

    async listValve() {
      const res = await getListValve(this.factoryId)
      this.itemValves = res.data.data
    }

  }
}
</script>

<style scoped>

</style>
