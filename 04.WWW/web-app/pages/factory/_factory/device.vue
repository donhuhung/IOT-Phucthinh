<template>
  <div>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
    <DeviceTemplate/>
  </div>
</template>

<script>
import DeviceTemplate from "../../../components/DeviceTemplate";
import {mapGetters} from "vuex";

export default {
  name: "device",
  components: {DeviceTemplate},
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
          href: '/factory',
        },
        {
          text: factory.name,
          disabled: false,
          href: `/factory/${factory.id}`,
        },
        {
          text: 'MONITORING & CONTROLLING DEVICES',
          disabled: true,
          href: 'breadcrumbs_link_2',
        },
      ]
    },
  },
}
</script>

<style scoped>

</style>
