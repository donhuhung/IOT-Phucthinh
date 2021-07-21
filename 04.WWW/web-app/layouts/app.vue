<template>
  <v-app>
    <v-navigation-drawer color="#363636" dark app permanent expand-on-hover>
      <SideBarProfile/>
      <v-divider></v-divider>
      <SideBarNavs/>
      <div class="mb-2"></div>
      <template v-slot:append>
        <LinkSignOut class="px-2"/>
      </template>
    </v-navigation-drawer>
    <v-main>
      <Nuxt class="px-2"/>
    </v-main>
    <notifications :speed="500" />
  </v-app>
</template>

<script>
import SideBarNavs from "../components/SideBarNavs";
import SideBarProfile from "../components/SideBarProfile";
import LinkSignOut from "../components/LinkSignOut";
export default {
  components: {LinkSignOut, SideBarProfile, SideBarNavs},
  middleware({store, redirect, route}) {
    if (!store.getters['auth/isLoggedIn']) {
      let query = {redirect: route.fullPath}
      redirect({path: '/auth/login', query})
    }
  },
}
</script>

<style lang="scss">
/*
  EXAMPLES
*/
.notification.n-light {

  margin: 10px;
  margin-bottom: 0;
  border-radius: 3px;
  font-size: 13px;
  padding: 10px 20px;
  color: #495061;
  background: #EAF4FE;
  border: 1px solid #D4E8FD;
  .notification-title {
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 10px;
    color: #2589F3;
  }
}
.custom-template {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  text-align: left;
  font-size: 13px;
  margin: 5px;
  margin-bottom: 0;
  align-items: center;
  justify-content: center;
  &, & > div {
    box-sizing: border-box;
  }
  background: #E8F9F0;
  border: 2px solid #D0F2E1;
  .custom-template-icon {
    flex: 0 1 auto;
    color: #15C371;
    font-size: 32px;
    padding: 0 10px;
  }
  .custom-template-close {
    flex: 0 1 auto;
    padding: 0 20px;
    font-size: 16px;
    opacity: 0.2;
    cursor: pointer;
    &:hover {
      opacity: 0.8;
    }
  }
  .custom-template-content {
    padding: 10px;
    flex: 1 0 auto;
    .custom-template-title {
      letter-spacing: 1px;
      text-transform: uppercase;
      font-size: 10px;
      font-weight: 600;
    }
  }
}
.v-fade-left-enter-active,
.v-fade-left-leave-active,
.v-fade-left-move {
  transition: all .5s;
}
.v-fade-left-enter,
.v-fade-left-leave-to {
  opacity: 0;
  transform: translateX(-500px) scale(0.2);
}

</style>
