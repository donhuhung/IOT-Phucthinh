<template>
  <v-container fluid>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
    <template>
      <Map></Map>
    </template>
  </v-container>
</template>

<script>
import Map from "../../components/Map"
import factoryMixin from "@/mixins/factoryMixin";
export default {
  components: {Map},
  mixins: [factoryMixin],
  computed: {
    links() {
      const {factory} = this
      return [
        {
          text: 'Factory',
          disabled: false,
          exact: true,
          to: '/factory',
        },
        {
          text: factory.name,
          disabled: false,
          exact: true,
          to: `/factory/${factory.id}`,
        },
        {
          text: 'MAPS',
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
