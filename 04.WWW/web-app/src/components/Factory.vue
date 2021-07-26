<template>
  <div>
    <div class="box-factory">
      <div class="d-flex flex-wrap">
        <template v-for="(item) in items">
          <v-card :key="item.id" width="350px"
                  class="box-factory--item"
                  :to="`${rootLink}/${item.factory_id}/overview`">
            <v-card-title>
              {{ item.name }}
            </v-card-title>
            <v-card-text>
              <div>
                Địa chỉ: {{ item.address }}
              </div>
              <div>
                IP: {{ item.ip }}
              </div>
            </v-card-text>
            <v-card-text>
              <img class="d-block" style="max-width: 100%" :src="`${item.thumbnail}`">
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
  computed: {
    rootLink() {
      const { params: {customer} } = this.$route
      return `/customers/${customer}/factory`
    }
  },
  mounted() {
    this.listFactory()
  },
  methods: {
    async listFactory() {
      const customerID = this.$route.params.customer
      const res = await getListFactory(customerID)
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
