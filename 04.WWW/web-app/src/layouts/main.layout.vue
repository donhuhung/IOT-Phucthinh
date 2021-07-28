<template>
  <v-app>
    <v-app-bar
        app dense
        color="primary"
        dark>
      <v-app-bar-nav-icon @click="toggleNavigation"></v-app-bar-nav-icon>
      <v-btn :to="`${rootLink}`" icon>
        <v-icon>mdi-home</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <router-view name="local-toolbar"/>
    </v-app-bar>
    <v-navigation-drawer app :mini-variant="mini">
      <SideBarProfile/>
      <v-divider/>
      <router-view name="local-menu"/>
      <template v-slot:append>
        <v-divider/>
        <LocaleChange>
          <template v-slot:activator="{ on, value }">
            <v-list-item link v-on="on" dense>
              <v-list-item-icon>
                <img class="d-block" width="20" height="20" :src="value.icon" alt=""/>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{ $t('layout.labelLanguage') }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </LocaleChange>
        <ThemeDarkLight>
          <template v-slot:activator="{ on }">
            <v-list-item link v-on="on" dense>
              <v-list-item-icon>
                <v-icon>mdi-theme-light-dark</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>
                  {{ $t('layout.labelTheme') }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </ThemeDarkLight>
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
import SideBarProfile from "../components/SideBarProfile";
import LocaleChange from "../components/LocaleChange";
import ThemeDarkLight from "../components/ThemeDarkLight";
import NotifyFlash from "../components/NotifyFlash";

export default {
  name: "MainLayout",
  components: {NotifyFlash, ThemeDarkLight, LocaleChange, SideBarProfile},
  data() {
    return {
      mini: true
    }
  },
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
  methods: {
    toggleNavigation() {
      this.mini = !this.mini
    }
  }
}
</script>

<style scoped>

</style>
