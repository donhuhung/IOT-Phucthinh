<template>
  <div>
    <div class="box-factory mx-n2">
      <v-fade-transition group tag="div" class="d-flex flex-wrap" leave-absolute>
        <div class="d-flex flex-wrap w-full space-x" key="loader" v-if="getting">
          <template v-for="i in 4">
            <v-skeleton-loader type="card-avatar, article, action" class="mb-2" width="33.333%" :key="i"/>
          </template>
        </div>
        <template v-for="(item) in items">
          <div :key="item.id" class="pa-2">
            <v-card width="350px"
                  class="box-factory--item">
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
              <div class="thumbnail-box">
                <img :src="item.thumbnail" class="d-block w-full" loading="lazy" alt="">
              </div>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" shaped depressed class="link-item mx-auto"
                     :to="`${rootLink}/${item.factory_id}/overview`">
                <span style="letter-spacing: 0px;">Truy Cập</span>
              </v-btn>
            </v-card-actions>
          </v-card>
          </div>
        </template>
      </v-fade-transition>
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
      items: [],
      getting: false,
    }
  },
  computed: {
    rootLink() {
      const {params: {customer}} = this.$route
      return `/customers/${customer}/factory`
    }
  },
  mounted() {
    this.listFactory()
  },
  methods: {
    async listFactory() {
      const customerID = this.$route.params.customer
      try {
        this.getting = true
        const res = await getListFactory(customerID)
        const {data} = res.data
        this.items = data
      } finally {
        this.getting = false
      }
    }
  }

}
</script>

<style scoped lang="scss">
.box-factory--item {
  .thumbnail-box {
    //border: solid 1px red;
    height: 200px;
    overflow: hidden;
  }
}
</style>
