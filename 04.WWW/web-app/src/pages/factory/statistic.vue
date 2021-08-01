<template>
  <div>
    <router-view />
    <router-view name="local-panel" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      electrical: {},
      chemical: {},
      flowmeter: {},
    }
  },

}
</script>

<style scoped lang="scss">

</style>
