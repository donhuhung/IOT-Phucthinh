<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      {{info.name}}
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & SCALLING SENSOR</p>
    <v-btn-toggle v-model="activetab" class="border-b w-full">
      <template v-for="(tab, index) in items">
        <v-btn :key="index" class="capitalize font-semibold text-blue-600"
               active-class="primary--text"
               style="margin-bottom: -1px;">
          <i class="fas fa-map-marked-alt mr-2"></i>
          {{ tab.title }}
        </v-btn>
      </template>
    </v-btn-toggle>
    <div class="mt-2">
      <template v-if="items[activetab]">
        <div class="-mx-2">
          <div class="flex flex-wrap">
            <template v-for="(data, index) in items[activetab]['data']">
              <div :key="index" class="px-2 mb-2 row-item-table">
                <GridOfSensor :name="data.name"
                              :symbol="data.symbol"
                              :dataSensor="data.data_sensor"/>
              </div>
            </template>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
import {getListSensor} from "@/api/app"
import GridOfSensor from "../../../components/GridOfSensor";

export default {
  components: {GridOfSensor},
  props: [
    'title'
  ],
  data() {
    return {
      active: false,
      activetab: 0,
      items: [],
    }
  },
  computed: {
    ...mapGetters({
      user:'auth/user',
    }),
    info() {
      const { factory } = this.user
      return factory || {}
    }
  },
  mounted() {
    this.listSensor()
  },
  methods: {
    getListSensor,
    async listSensor() {
      let factory_id = this.$route.params.factory;
      const res = await this.getListSensor(factory_id)
      this.items = res.data
    }
  }
}
</script>

<style scoped>
.row-item-table {
  min-width: 350px;
}
</style>
