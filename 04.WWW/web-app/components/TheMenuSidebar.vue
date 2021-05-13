<template>
  <ul class="mt-2 text-gray-700 dark:text-gray-400 capitalize">
    <!-- Links -->
    <template v-for="(nav, index) in navs">
      <li :key="index" class="mt-3 p-2 text-blue-600 dark:text-blue-300 rounded-lg">
        <nuxt-link :to="nav.to" class=" flex flex-col items-center">
          <img :src="require(`~/assets/img/${nav.icon}`)" />
          <span class="text-xs mt-2">{{ $t(nav.label) }}</span>
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
      ]
    }
  }
}
</script>

<style scoped>

</style>
