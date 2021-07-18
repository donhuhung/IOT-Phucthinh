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
    this.listMotor();
    this.listValve()
  },
  computed: {
    dataDevice() {
      const {panel, itemMotors, itemValves, child} = this
      const isMotor = child === 0
      // todo: handle items with type device: valve || motor
      const itemsMotor = itemMotors[panel] ? itemMotors[panel].data : []
      const itemsValve = itemValves[panel] ? itemValves[panel].data : []
      return isMotor ? itemsMotor : itemsValve
    }
  },
  methods: {
    getListMotor,
    async listMotor() {
      let factory_id = this.$route.params.factory;
      const res = await this.getListMotor(factory_id)
      this.itemMotors = res.data
    },

    getListValve,
    async listValve() {
      let factory_id = this.$route.params.factory;
      const res = await this.getListValve(factory_id)
      this.itemValves = res.data
    }

  }
}
</script>

<style scoped>

</style>
