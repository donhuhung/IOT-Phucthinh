import {getDetailFactory} from "@/api/app"
export default {
  data() {
    return {
      factory: {},
    }
  },
  async mounted() {
    await this.detailFactory()
  },
  methods:{
    async detailFactory(){
      let factory_id = this.$route.params.factory;
      const res = await getDetailFactory(factory_id)
      this.factory = res.data.data
    }
  }
}
