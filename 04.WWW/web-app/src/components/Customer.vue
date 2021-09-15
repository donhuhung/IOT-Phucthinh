<template>
  <div>
    <div class="box-factory">
      <div class="d-flex flex-wrap">
        <template v-for="(item) in items">
          <v-card :key="item.id" width="350px"
                  class="box-factory--item"
                  :to="`customers/${item.id}`">
            <v-card-title>
              {{ item.name }}
            </v-card-title>
            <v-card-text>
              <div>
                Địa chỉ: {{ item.address }}
              </div>
            </v-card-text>
            <v-card-text>
              <img class="d-block" style="width: 100%" :src="`${item.logo}`">
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" shaped depressed class="link-item">
                <span style="letter-spacing: 0px;">Truy Cập</span>
              </v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import {getListCustomer} from "../api/app";

export default {
  name: "ListCustomer",
  props: {
    title: {
      type: String,
      default: () => 'Thông tin Khách hàng'
    },
  },
  data() {
    return {
      items: []
    }
  },
  mounted() {
    this.listCustomer()
  },
  methods: {
    async listCustomer() {
      const res = await getListCustomer()
      const {data} = res.data
      this.items = data
    }
  }

}
</script>

<style scoped lang="scss">
.box-factory--item{
  margin-right: 10px;
}
</style>
