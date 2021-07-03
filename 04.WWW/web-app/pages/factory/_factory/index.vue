<template>
  <div>Detail Index</div>
</template>

<script>
export default {
  functional: true,
  middleware({ store, redirect, route }, error) {
    let {
      params: { factory },
    } = route
    redirect(`/factory/${factory}/overview`)
  },
}
</script>

<style scoped>

</style>
