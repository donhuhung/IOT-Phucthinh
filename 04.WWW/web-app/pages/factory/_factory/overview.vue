<template>
  <div>
    <h2 class="text-center text-2xl p-2 fm-bold" style="color: #007BFF;">
      {{info.name}}
    </h2>
    <div class="p-2 m-2">
      <img :src="info.overview">
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
  data() {
    return {
      info: [],
    }
  },
  computed: {
    ...mapGetters({
      user:'auth/user',
    }),
  },
  mounted() {
    this.getDetail();
  },
  methods: {
    getDetail() {
        this.info = this.user.factory;
    },
  }
}
</script>

<style scoped>

</style>
