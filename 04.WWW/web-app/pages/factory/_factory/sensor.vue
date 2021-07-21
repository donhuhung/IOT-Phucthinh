<template>
  <div>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
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
    <div class="">
      <template v-if="items[activetab]">
        <template v-if="items[activetab]['data_list'].length">
          <div class="-mx-2 py-2">
            <div class="flex flex-wrap">
              <template v-for="(data, index) in items[activetab]['data_list']">
                <div :key="index" class="row-item-table px-2 py-2">
                  <GridOfSensor :name="data.name"
                                :symbol="data.symbol"
                                :dataSensor="data.data_sensor"
                                :dataList="data"
                                :dateSync="dateSync"/>
                </div>
              </template>
            </div>
          </div>
        </template>
        <template v-else>
          <NotFoundData/>
        </template>
      </template>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
import {getListSensor} from "@/api/app"
import GridOfSensor from "../../../components/GridOfSensor";
import NotFoundData from "../../../components/NotFoundData";

export default {
  components: {NotFoundData, GridOfSensor},
  props: [
    'title'
  ],
  data() {
    return {
      active: false,
      activetab: 0,
      items: [],
      dateSync:Date.now()
    }
  },
  computed: {
    ...mapGetters({
      factory: 'auth/factory',
    }),
    links() {
      const {factory} = this
      return [
        {
          text: 'Factory',
          disabled: false,
          exact: true,
          to: '/factory',
        },
        {
          text: factory.name,
          disabled: false,
          exact: true,
          to: `/factory/${factory.id}`,
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
    async listSensor(){
      let factory_id = this.$route.params.factory;
      const res = await getListSensor(factory_id)
      this.items = res.data.data
      this.syncListSensor()
    },
    syncListSensor() {
      setInterval(async () => {
        let factory_id = this.$route.params.factory;
        const res = await getListSensor(factory_id)
        this.items = res.data.data
        this.dateSync = Date.now()
        console.log("Syncing Data")
      }, 45000);
    },
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
