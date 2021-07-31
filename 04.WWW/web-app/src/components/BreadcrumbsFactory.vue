<template>
  <v-breadcrumbs :items="links"></v-breadcrumbs>
</template>

<script>
export default {
  name: "BreadcrumbsFactory",
  props: {
    factory: {
      type: Object,
      default: () => ({}),
    }
  },
  computed: {
    links() {
      const {factory = {}} = this
      const {meta = {}} = this.$route
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
          text: meta.breadcrumb,
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
