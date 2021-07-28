<template>
  <v-toolbar-items>
    <template v-for="(nav, index) in navs">
      <v-btn :key="index" text :to="`${rootLink}/${nav.to.path}`">
        <v-icon left>{{ nav.icon }}</v-icon>
        {{ $t(nav.label) }}
      </v-btn>
    </template>
  </v-toolbar-items>
</template>

<script>
import navs from '../../json/navs.json'

export default {
  name: "toolbar-factory",
  computed: {
    navs() {
      return navs
    },
    rootLink() {
      const {params: {customer, factory}} = this.$route
      return `/customers/${customer}/factory/${factory}`
    }
  }
}
</script>

<style scoped>

</style>
