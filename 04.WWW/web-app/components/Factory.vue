<template>
  <div>
    <div class="flex items-center justify-between">
      <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
        {{ title }}
      </h3>
    </div>
    <div class="box-factory">
      <div class="flex flex-wrap">
        <div class="box-factory--item" v-for="item in items">
          <div class="header">
            <p class="m-0 mb-0">{{ item.name }}</p>
          </div>
          <div class="body">
            <p><span class="xl:font-bold">Địa chỉ: </span>{{ item.address }}
            </p>
            <p><span class="xl:font-bold">IP: </span>{{ item.ip }}</p>
            <img :src="`${item.thumbnail}`" class="w-full mt-4">
          </div>
          <div class="footer">
            <router-link :to="`/factory/${item.factory_id}`">
              Truy cập
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import {getListFactory} from "../api/app";

export default {
  name: "ListFactory",
  props: {
    title: {
      type: String,
      default: () => 'Thông tin Nhà Máy'
    },
  },
  data() {
    return {
      items: []
    }
  },
  computed: {},
  mounted() {
    this.testGetListFactory()
  },
  methods: {
    getListFactory,
    async testGetListFactory() {
      const res = await this.getListFactory()
      console.error('FACTORY', res)
      const {data} = res
      this.items = data
    }
  }

  /*methods: {
    async getListFactory(){
      let obj = await this.$axios.$get('/api/v1/factory/list')
      this.items = obj.data;
    }
  },*/

}
</script>

<style scoped lang="scss">
.box-factory {
  padding: 40px 0;
  .box-factory--item {
    //max-width: 350px;
    width: calc(100% / 4);
  }
}

.header {
  background: #007BFF;
  padding: 10px;
  text-align: center;
  color: #fff;
  font-family: 'RobotoMedium', sans-serif;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.body {
  background: #FAFAFA;
  padding: 20px;
  color: #73879C;
}

.footer {
  background: #fff;
  padding: 20px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  box-shadow: 0px 18px 12px 0px rgb(217 218 227 / 80%);
}

.footer a {
  color: #fff;
  text-align: center;
  background: #1ABB9C;
  padding: 5px;
  border-radius: 45px;
  margin: auto;
  display: block;
  width: 60%;
}
</style>
