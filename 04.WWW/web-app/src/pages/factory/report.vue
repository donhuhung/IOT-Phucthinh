<template>
  <div>
    <template v-for="r in ['device','electrical', 'chemical', 'flowmeter']">
      <v-btn :key="r" :to="{name: `report-${r}`, params: $route.params}">
        {{ r }}
      </v-btn>
    </template>
    <router-view />
  </div>
</template>

<script>
export default {
  created() {
    const { params } = this.$route
    if(this.$route.name === `factory-report`) {
      this.$router.push({name: 'report-device', params})
    }
  }
}
</script>

<style scoped>

</style>
