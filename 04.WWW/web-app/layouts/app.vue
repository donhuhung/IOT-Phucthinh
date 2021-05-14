<template>
  <div class="h-screen w-full flex overflow-hidden select-none">
    <nav class="w-50 flex flex-col items-center dark:bg-gray-800 overflow-y-auto">
      <!-- Left side NavBar -->
      <div class="box-logo">
        <!-- App Logo -->
        <img class="p-2" loading="lazy" src="~/assets/img/logo-phuc-thinh-22.png" alt=""/>
      </div>
      <TheMenuSidebar/>
    </nav>
    <main
      class="flex-1 bg-gray-200 dark:bg-black rounded-l-lg border-l
		transition duration-500 ease-in-out overflow-y-auto">
      <TheTopBar class="sticky top-0 z-20 border-b"/>
      <div class="px-4 py-2 min-h-full">
        <Nuxt/>
      </div>
    </main>
  </div>
</template>

<script>
import TheTopBar from "../components/TheTopBar";
import TheMenuSidebar from "../components/TheMenuSidebar";

export default {
  components: {TheMenuSidebar, TheTopBar},
  middleware({store, redirect, route}) {
    if (!store.getters['auth/isLoggedIn']) {
      let query = {redirect: route.fullPath}
      redirect({path: '/auth/login', query})
    }
  },
  data() {
    return {
      navs: [
        {
          label: 'layout.navFactory',
          icon: 'Home-Icon.svg',
          to: {
            path: '/factory'
          }
        },
        {
          label: 'layout.navOverview',
          icon: 'icon-overview.svg',
          to: {
            path: '/overview'
          }
        },
        {
          label: 'layout.navSensor',
          icon: 'sensor.svg',
          to: {
            path: '/sensor'
          }
        },
        {
          label: 'layout.navDevice',
          icon: 'device.svg',
          to: {
            path: '/device'
          }
        },
        {
          label: 'layout.navChart',
          icon: 'bar-chart.svg',
          to: {
            path: '/chart'
          }
        },
        {
          label: 'layout.navMaps',
          icon: 'place.svg',
          to: {
            path: '/maps'
          }
        },
        {
          label: 'layout.navSetting',
          icon: 'settings.svg',
          to: {
            path: '/setting'
          }
        },
      ]
    }
  }
}
</script>

<style scoped>
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
nav{
  background-color: #c4dec0;
}
h2{
  font-family: 'RobotoBold',sans-serif;
}
.box-logo{
  background-color: #1E87F0;
}
.box-logo img{
  width: 70% !important;
}
</style>
