<template>
  <div>
    <div class="p-2 m-2">
      <img :src="info.overview">
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
  computed: {
    ...mapGetters({
      user:'auth/user',
    }),
    info() {
      const { factory } = this.user
      return factory || {}
    }
  },
}
</script>

<style scoped>

</style>
