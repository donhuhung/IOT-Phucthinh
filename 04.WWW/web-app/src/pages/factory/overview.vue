<template>
  <div>
    <v-img :src="factory.overview"/>
  </div>
</template>

<script>
import factoryMixin from "@/mixins/factoryMixin"
export default {
  mixins: [factoryMixin],
}
</script>

<style scoped>

</style>
