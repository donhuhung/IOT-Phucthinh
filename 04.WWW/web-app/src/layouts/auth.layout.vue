<template>
  <v-app>
    <v-card img="/assets/img/banner-login.png" color="transparent" height="100%">
      <img class="text-center m-auto logo-layout" loading="lazy"
           src="/assets/img/logo-phuc-thinh-22.png" alt=""/>
      <div class="locale-layout">
        <LocaleChange />
      </div>
      <router-view />
    </v-card>
    <v-snackbar v-model="showMessage" top right>
      {{ message }}
    </v-snackbar>
  </v-app>
</template>

<script>
import LocaleChange from "../components/LocaleChange";
export default {
  name: "AuthLayout",
  components: {LocaleChange},
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
  .locale-layout {
    position: absolute;
    right: 10px;
    top: 10px;
  }
</style>
