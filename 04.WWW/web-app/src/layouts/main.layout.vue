<template>
  <v-app>
    <v-app-bar
        app dense
        color="primary"
        dark>
      <v-btn to="/" icon>
        <v-icon>mdi-home</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <router-view name="local-toolbar"/>
    </v-app-bar>
    <v-navigation-drawer app>
      <SideBarProfile/>
      <v-divider/>
      <router-view name="local-menu"/>
      <template v-slot:append>
        <v-divider/>
        <div class="d-flex">
          <LinkSignOut/>
          <v-spacer />
          <ThemeDarkLight />
          <LocaleChange/>
        </div>
      </template>
    </v-navigation-drawer>
    <v-main color="#f5f7f9">
      <router-view/>
      <v-snackbar v-model="showMessage" top right>
        {{ message }}
      </v-snackbar>
    </v-main>
  </v-app>
</template>

<script>
import LinkSignOut from "../components/LinkSignOut"
import SideBarProfile from "../components/SideBarProfile";
import LocaleChange from "../components/LocaleChange";
import ThemeDarkLight from "../components/ThemeDarkLight";

export default {
  name: "MainLayout",
  components: {ThemeDarkLight, LocaleChange, SideBarProfile, LinkSignOut},
  data() {
    return {
      message: undefined,
      showMessage: false
    }
  },
  mounted() {
    this.$bus.$on('notify', ({message}) => {
      this.message = message
      this.showMessage = true
    })
  },
  methods: {
    logout() {
      this.$store.commit('auth/logout')
      this.redirectLogin()
    },
    redirectLogin() {
      let query = {redirect: this.$route.fullPath}
      this.$router.replace({path: '/auth/login', query})
    },
  }
}
</script>

<style scoped>

</style>
