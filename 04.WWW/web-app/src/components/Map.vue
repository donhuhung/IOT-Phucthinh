<template>
  <div>
    <br>
    <h1>Vue Js Add Multiple Markers on Google Maps Example - Tutsmake.com</h1>

    <gmap-map
        :center="center"
        :zoom="12"
        style="width:100%;  height: 400px;"
    >
      <gmap-marker
          :key="index"
          v-for="(m, index) in markers"
          :position="m"
          @click="center=m"
      >
        <h4>{{m.label}}</h4>
      </gmap-marker>
    </gmap-map>

  </div>
</template>
<script>
export default {
  name: "GoogleMap",
  data() {
    return {
      center: { lat: 45.508, lng: -73.587 },
      markers: [],
      currentPlace: null
    };
  },

  mounted() {
    this.geolocate();
  },

  methods: {
    setPlace(place) {
      this.currentPlace = place;
    },
    geolocate: function() {

      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });

      this.markers = [
        {
          lat: 21.1594627,
          lng: 72.6822083,
          label: 'Surat'
        }
      ];

    }
  }
};
</script>

<style scoped lang="scss">

</style>
