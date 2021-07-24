<template>
  <v-container fluid>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
    <DeviceTemplate/>
  </v-container>
</template>

<script>
import DeviceTemplate from "../../components/DeviceTemplate";
import {mapGetters} from "vuex";

export default {
  components: {DeviceTemplate},
  computed: {
    ...mapGetters({
      factory: 'auth/factory',
    }),
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

