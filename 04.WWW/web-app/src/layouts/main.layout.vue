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
      <v-divider />
      <router-view name="local-menu"/>
      <template v-slot:append>
        <LinkSignOut class="px-2"/>
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

export default {
  name: "MainLayout",
  components: {SideBarProfile, LinkSignOut},
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
