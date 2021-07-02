<template>
  <v-list nav dense>
    <template v-for="(nav, index) in navs">
      <v-list-item link :key="index" :to="nav.to">
        <v-list-item-icon>
          <v-img :src="`${nav.icon}`"/>
        </v-list-item-icon>
        <v-list-item-title>{{ $t(nav.label) }}</v-list-item-title>
      </v-list-item>
    </template>
  </v-list>
</template>

<script>
export default {
  name: "SideBarNavs",
  data() {
    return {
      navs: [
        {
          label: 'layout.navFactory',
          icon: '/img/Home-Icon.svg',
          to: {
            path: '/factory'
          }
        },
        {
          label: 'layout.navOverview',
          icon: '/img/icon-overview.svg',
          to: {
            path: '/overview'
          }
        },
        {
          label: 'layout.navSensor',
          icon: '/img/sensor.svg',
          to: {
            path: '/sensor'
          }
        },
        {
          label: 'layout.navDevice',
          icon: '/img/device.svg',
          to: {
            path: '/device'
          }
        },
        {
          label: 'layout.navChart',
          icon: '/img/bar-chart.svg',
          to: {
            path: '/chart'
          }
        },
        {
          label: 'layout.navMaps',
          icon: '/img/place.svg',
          to: {
            path: '/maps'
          }
        },
        {
          label: 'layout.navSetting',
          icon: '/img/settings.svg',
          to: {
            path: '/setting'
          }
        }
      ],
    }
  }
}
</script>

<style scoped>

</style>
