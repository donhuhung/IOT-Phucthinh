<template>
  <v-container fluid>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
    <DeviceTemplate/>
  </v-container>
</template>

<script>
import DeviceTemplate from "../../components/DeviceTemplate";
import factoryMixin from "@/mixins/factoryMixin"

export default {
  components: {DeviceTemplate},
  mixins: [factoryMixin],
  computed: {
    links() {
      const {factory = {}} = this
      return [
        {
          text: 'Factory',
          disabled: false,
          link: true,
          exact: true,
          to: '/factory',
        },
        {
          text: factory.name,
          disabled: false,
          link: true,
          exact: true,
          to: `/factory/${factory.id}`,
        },
        {
          text: 'MONITORING & CONTROLLING DEVICES',
          disabled: true,
          link: true,
          exact: true,
          to: 'breadcrumbs_link_2',
        },
      ]
    },
  },
}
</script>

<style scoped>

</style>

