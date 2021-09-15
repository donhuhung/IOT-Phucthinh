<template>
  <div>
    <div class="tab-menu-report">
      <template v-for="r in ['device','electrical', 'chemical', 'flowmeter']">
        <v-btn :key="r" :to="{name: `report-${r}`, params: $route.params}">
          {{ r }}
        </v-btn>
      </template>
    </div>
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
.tab-menu-report{
  background-color: #f5f5f5;
}
.v-btn--is-elevated{
  box-shadow: none;
}
.v-btn--active{
  color:#1976d2;
}
</style>
