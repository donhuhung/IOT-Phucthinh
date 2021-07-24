import {getDetailFactory} from "@/api/app"
export const factoryMixin = {
  methods:{
    async getDetailFactory(){
      let factory_id = this.$route.params.factory;
      const res = await getDetailFactory(factory_id)
      return res.data.data
    }
  }
}