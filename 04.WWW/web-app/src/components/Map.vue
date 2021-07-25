<template>
  <v-container>
    <div class="info-windows">

    </div>
  </v-container>

</template>
<script>
import cities from '@/json/cities.json'

export default {
  data() {
    return {
      showInfo: false,
      infoWindowContext: {
        position: {
          lat: 44.2899,
          lng: 11.8774
        }
      },
      infoWindowsList: cities
    }
  },
  methods: {
    toggleInfoWindow(context) {
      this.infoWIndowContext = context
      this.showInfo = true
    },
    infoClicked(context) {
      console.log(context)
    }
  }
}
</script>

<style scoped lang="scss">

</style>
