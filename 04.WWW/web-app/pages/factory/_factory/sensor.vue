<template>
  <div>
    <v-breadcrumbs :items="links"></v-breadcrumbs>
    <v-app-bar height="40px" flat>
      <v-tabs v-model="activetab">
        <template v-for="(tab, index) in items">
          <v-tab :key="index">
            <div class="text-xs df_text">
              {{ tab.title }}
            </div>
          </v-tab>
        </template>
      </v-tabs>
    </v-app-bar>

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
      factory: 'auth/factory',
    }),
    links() {
      const { factory } = this
      return [
        {
          text: 'Factory',
          disabled: false,
          href: '/factory',
        },
        {
          text: factory.name,
          disabled: false,
          href: `/factory/${factory.id}`,
        },
        {
          text: 'MONITORING & SCALLING SENSOR',
          disabled: true,
          href: 'breadcrumbs_link_2',
        },
      ]
    },
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
.df_text {
  letter-spacing: 0px;
}
</style>
