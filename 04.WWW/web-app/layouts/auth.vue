<template>
  <div>
    <Nuxt/>
  </div>
</template>

<script>
export default {
  middleware({ store, redirect, route }) {
    console.error(store)
    if (store.getters['auth/isLoggedIn']) {
      let path = route.query['redirect'] || '/'
      return redirect(path)
    }
  },
}
</script>

<style scoped>

</style>
