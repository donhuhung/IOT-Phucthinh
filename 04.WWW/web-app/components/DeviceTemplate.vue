<template>
  <div>
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
    <GridOfDevice :dataDevice="dataDevice" />
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
    }
  },
  mounted() {
    this.listDevice()
  },
  computed: {
    dataDevice() {
      const { panel, items } = this
      return items[panel] ? items[panel].data : []
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
