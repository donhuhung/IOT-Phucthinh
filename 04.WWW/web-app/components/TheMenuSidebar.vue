<template>
  <ul class="mt-2 text-gray-700 dark:text-gray-400 capitalize w-full">
    <!-- Links -->
    <template v-for="(nav, index) in navs">
      <li :key="index" class="mt-3 p-1 pl-3 text-blue-600 dark:text-blue-300 rounded-lg">
        <nuxt-link :to="nav.to" class=" flex items-center">
          <img :src="require(`~/assets/img/${nav.icon}`)" />
          <span class="text-xl m-3 pl-4" style="color:#000A12"
                @click="selected = index"
                :class="{active:selected == index}"
          >{{ $t(nav.label) }}</span>
        </nuxt-link>
      </li>
    </template>

  </ul>
</template>

<script>
export default {
  name: "TheMenuSidebar",
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
      ],
      selected: ''
    }
  }
}
</script>

<style scoped>
nav li{
  border-bottom: 1px solid #EEEEEE;
}
nav li:hover span{
  color:#007BFF !important;
}
nav li .active{
  color:#007BFF !important;
}
</style>
