<template>
  <v-app>
    <v-navigation-drawer app permanent expand-on-hover>
      <SideBarProfile />
      <v-divider></v-divider>
      <SideBarNavs/>
      <div class="mb-2"></div>
      <template v-slot:append>
        <LinkSignOut class="px-2" />
      </template>
    </v-navigation-drawer>
    <v-app-bar app flat color="white">
      <TheTopBar/>
    </v-app-bar>
    <v-main class="grey lighten-3">
      <v-container fluid>
        <Nuxt/>
      </v-container>
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

<style>
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

h3.title {
  font-family: 'RobotoLight', sans-serif;
  font-size: 35px;
  padding-left: 15px;
}

h2 {
  font-family: 'RobotoBold', sans-serif;
}

.box-logo img {
  width: 50% !important;
  margin: auto;
  display: block;
}

.text-green-pt {
  color: #1ABB9C;
}

.font-bold-italic {
  font-family: 'RobotoBoldItalic', sans-serif;
}

.font-light {
  font-family: 'RobotoLight', sans-serif;
}
</style>
