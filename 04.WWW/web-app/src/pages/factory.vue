<template>
  <v-container fluid>
    <BreadcrumbsFactory class="px-0" :factory="factory"/>
    <router-view />
  </v-container>
</template>

<script>
import BreadcrumbsFactory from "../components/BreadcrumbsFactory";
import factoryMixin from "../mixins/factoryMixin";
export default {
  components: {BreadcrumbsFactory},
  mixins: [factoryMixin]
}
</script>

<style scoped>

</style>
