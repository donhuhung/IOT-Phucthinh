<template>
  <div class="">
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
      <NotFoundData />
    </template>
  </div>
</template>

<script>
import GridOfDevice from "./GridOfDevice";
import {getListMotor, getListValve} from "../api/app"
import NotFoundData from "./NotFoundData";

export default {
  name: "DeviceTemplate",
  components: {NotFoundData, GridOfDevice},
  data() {
    return {
      panel: 0,
      itemMotors: [],
      itemValves: [],
      children: ['motor', 'valve'],
      child: 0,
      timer: undefined,
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
      const itemsMotor = itemMotors[panel] ? itemMotors[panel].data_motor : []
      const itemsValve = itemValves[panel] ? itemValves[panel].data_valve : []
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
      this.syncListMotor();
    },
    syncListMotor() {
      this.timer = setInterval(async () => {
        const res = await getListMotor(this.factoryId)
        this.itemMotors = res.data.data
        clearInterval(this.timer)
      }, 45000);
    },
    async listValve() {
      const res = await getListValve(this.factoryId)
      this.itemValves = res.data.data
    },
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>

<style scoped>

</style>
