<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      {{info.name}}
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & CONTROLLING DEVICES</p>
    <div class="mt-6"></div>
    <v-expansion-panels focusable hover v-model="panel">
      <v-expansion-panel
          v-for="(item,i) in items"
          :key="i"
      >
        <v-expansion-panel-header>
          <div class="uppercase font-semibold text-blue-600">
            <i class="fas fa-map-marked-alt mr-2"></i>
            {{ item.title }}
          </div>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-divider></v-divider>
          <GridOfDevice :dataDevice="item.data"/>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
import GridOfDevice from "./GridOfDevice";
import {getListDevice} from "@/api/app"
import GridTable from "./GridTable";
export default {
  name: "DeviceTemplate",
  components: {GridTable, GridOfDevice},
  data() {
    return {
      panel: [0],
      items: [],
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
    info() {
      const {factory} = this.user
      return factory || {}
    }
  },
  mounted() {
    this.listDevice()
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
