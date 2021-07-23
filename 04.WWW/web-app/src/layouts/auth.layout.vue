<template>
  <v-app>
    <v-card img="/assets/img/banner-login.png" color="transparent" height="100%">
      <img class="text-center m-auto logo-layout" loading="lazy"
           src="/assets/img/logo-phuc-thinh-22.png" alt=""/>
      <router-view />
    </v-card>
    <v-snackbar v-model="showMessage" top right>
      {{ message }}
    </v-snackbar>
  </v-app>
</template>

<script>
export default {
  name: "AuthLayout",
  data() {
    return {
      message: undefined,
      showMessage: false
    }
  },
  mounted() {
    this.$bus.$on('notify', ({ message }) => {
      this.message = message
      this.showMessage = true
    })
  },

}
</script>

<style scoped lang="scss">
  .logo-layout {
    display: block;
    position: absolute;
    left: 10px;
    top: 10px;
    img {
      display: block;

    }
  }
</style>
