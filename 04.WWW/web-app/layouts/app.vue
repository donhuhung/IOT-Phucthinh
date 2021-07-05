<template>
  <v-app>
    <v-navigation-drawer app permanent expand-on-hover>
      <SideBarProfile/>
      <v-divider></v-divider>
      <SideBarNavs/>
      <div class="mb-2"></div>
      <template v-slot:append>
        <LinkSignOut class="px-2"/>
      </template>
    </v-navigation-drawer>
    <v-app-bar app dense flat class="v-bar--underline">
      <TheTopBar/>
    </v-app-bar>
<!--    <v-toolbar outlined ap></v-toolbar>-->
    <v-main class="">
      <Nuxt class="px-2"/>
    </v-main>
  </v-app>
</template>

<script>
import TheTopBar from "../components/TheTopBar";
import SideBarNavs from "../components/SideBarNavs";
import SideBarProfile from "../components/SideBarProfile";
import LinkSignOut from "../components/LinkSignOut";

export default {
  components: {LinkSignOut, SideBarProfile, SideBarNavs, TheTopBar},
  middleware({store, redirect, route}) {
    if (!store.getters['auth/isLoggedIn']) {
      let query = {redirect: route.fullPath}
      redirect({path: '/auth/login', query})
    }
  },
  data() {
    return {}
  },

}
</script>

<style lang="scss">
@font-face {
  font-family: RobotoMedium;
  src: url(~/assets/fonts/Roboto-Medium.ttf);
}

@font-face {
  font-family: RobotoRegular;
  src: url(~/assets/fonts/Roboto-Regular.ttf);
}

@font-face {
  font-family: RobotoBold;
  src: url(~/assets/fonts/Roboto-Bold.ttf);
}

@font-face {
  font-family: RobotoLight;
  src: url(~/assets/fonts/Roboto-Light.ttf);
}

@font-face {
  font-family: RobotoBoldItalic;
  src: url(~/assets/fonts/Roboto-BoldItalic.ttf);
}
.v-bar--underline {
  border-bottom: solid 1px rgba(0, 0, 0, 0.12) !important;

}
</style>
