<template>
  <v-app>
    <v-app-bar
        app dense
        color="primary"
        dark>
      <v-btn :to="`${rootLink}`" icon>
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
    <v-main style="background: #eee;">
      <router-view/>
      <NotifyFlash />
    </v-main>
  </v-app>
</template>

<script>
import {mapGetters} from 'vuex';
import LinkSignOut from "../components/LinkSignOut"
import SideBarProfile from "../components/SideBarProfile";
import LocaleChange from "../components/LocaleChange";
import ThemeDarkLight from "../components/ThemeDarkLight";
import NotifyFlash from "../components/NotifyFlash";

export default {
  name: "MainLayout",
  components: {NotifyFlash, ThemeDarkLight, LocaleChange, SideBarProfile, LinkSignOut},
  computed: {
    ...mapGetters({
      user: 'auth/user',
      groupUser: 'auth/groupUser'
    }),
    rootLink(){
      const {groupUser} = this
      let customerID = this.user.customer.id;
      return groupUser === 'super_admin_app' ? '/' : '/customers/' + customerID
    }
  },
}
</script>

<style scoped>

</style>
