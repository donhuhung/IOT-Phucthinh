<template>
  <div>
    <template v-if="loading">
      <v-skeleton-loader type="table" width="100%"/>
    </template>
    <v-img v-if="showImage" :src="factory.overview" @load="onImageLoad"/>
  </div>
</template>

<script>
import {getDetailFactory} from "@/api/app";

export default {
  data() {
    return {
      factory: {},
      showImage: true,
      loading: true,
    }
  },
  async mounted() {
    await this.detailFactory()
  },
  methods: {
    async detailFactory(){
      let factory_id = this.$route.params.factory;
      const res = await getDetailFactory(factory_id)
      this.factory = res.data.data
      this.syncDetailFactory()
    },
    syncDetailFactory() {
      this.timer = setInterval(async () => {
        this.loading = true;
        this.showImage = false
        let factory_id = this.$route.params.factory;
        const res = await getDetailFactory(factory_id)
        this.factory = res.data.data
        this.showImage = true
      }, 45000);
    },
    onImageLoad(){
      this.loading = false;
    }
  }
}
</script>

<style scoped>

</style>
