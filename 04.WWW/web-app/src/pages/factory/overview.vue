<template>
  <v-container fluid>
    <v-breadcrumbs class="px-0" :items="links"></v-breadcrumbs>
      <v-img :src="factory.overview"/>
  </v-container>
</template>

<script>
import factoryMixin from "@/mixins/factoryMixin"
export default {
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
          text: 'OVERVIEW',
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
