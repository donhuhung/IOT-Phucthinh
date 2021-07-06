<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      HA THANH WATER SUPPLY FACTORY, 30.000m3 Capacity
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & SCALLING SENSOR</p>
    <div id="tabs" class="mt-6">
      <div class="tabs bg-blue-200 p-2">
        <a v-for="(item,index) in items" href="javascript:void(0)"  class="m-0 px-4 text-blue-600"  v-on:click="activetab=(index+1)" v-bind:class="[ activetab == (index+1) ? 'active' : '' ]">
          <i class="fas fa-map-marked-alt"></i>
          {{ item.title }}
        </a>

      </div>

      <div class="content group-table bg-white mt-4">
        <div v-for="(item,index) in items" v-if="activetab == (index+1)" class="tabcontent">
          <div class="flex items-start flex-wrap p-2">
            <template v-for="(tb, index) in item.data">
              <TableInformationSensor :key="(index+1)"
                                      class="w-80 m-2"
                                      disabled-title
                                      v-bind="tb"/>
            </template>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
import TableInformationSensor from "@/components/TableInformationSensor";
import {getListSensor} from "@/api/app"
export default {
  components: {TableInformationSensor},
  props: [
    'title'
  ],
  data() {
    return {
      active: false,
      activetab: '1',
      items: []
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
.tabs a.active{
  color:#1ABB9C;
  font-family: 'RobotoBold',sans-serif;
}
.tabs a{
  font-size: 18px;
}
</style>
