<template>
  <div>
    <template v-for="(nav, index) in navs">
      <v-btn :key="index" text :to="`${rootLink}/${nav.to.path}`">{{ $t(nav.label) }}</v-btn>
    </template>
  </div>
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
