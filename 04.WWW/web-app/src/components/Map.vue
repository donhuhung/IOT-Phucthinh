<template>
  <v-container fluid>
    <div class="d-flex">
      <div class="w-60">
        <gmap-map ref="mymap" :center="center" :zoom="6" style="width: 100%; height: 600px">
        <gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
          {{infoContent}}
        </gmap-info-window>
        <gmap-marker v-for="(m, index) in markers" :key="index" :position="getPosition(m)" :clickable="true" @click="toggleInfo(m, index)" />
        </gmap-map>
      </div>
      <div class="w-40">
        <ul>
          <li style="cursor: pointer" v-for="(m, index) in markers" :key="index" @click="setCurrentPlace(m, index)">
            <h3>
              {{m.title}}
            </h3>
            <p>Địa chỉ: {{m.address}}</p>
          </li>
        </ul>
      </div>
    </div>
  </v-container>
</template>
<script>
import {getListFactory} from "../api/app";
export default {
  name: "GoogleMap",
  data() {
    return {
      center: { lat: 19.359690, lng: 105.750470 },
      markers: [],
      factory:[],
      infoPosition: null,
      infoContent: null,
      infoOpened: false,
      infoCurrentKey: null,
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -35
        }
      },
    };
  },

  mounted() {
    this.listFactory()
  },

  methods: {
    setCurrentPlace:function(marker, key){
      this.center.lat = parseFloat(marker.position.lat)
      this.center.lng = parseFloat(marker.position.lng)
      this.toggleInfo(marker,key)
    },
    getPosition: function(marker) {
      return {
        lat: parseFloat(marker.position.lat),
        lng: parseFloat(marker.position.lng)
      }
    },
    toggleInfo: function(marker, key) {
      this.infoPosition = this.getPosition(marker)
      this.infoContent = marker.title
      if (this.infoCurrentKey == key) {
        this.infoOpened = !this.infoOpened
      } else {
        this.infoOpened = true
        this.infoCurrentKey = key
      }
    },
    async listFactory() {
        const customerID = this.$route.params.customer
        const res = await getListFactory(customerID)
        const {data} = res.data
        this.factory = data
        this.parseObjectMarker()
    },
    parseObjectMarker:function(){
      let arrList = []
      this.factory.map(function(value,key) {
        let list = new Object();
        let position = new Object();
        position.lat = parseFloat(value.langtitude)
        position.lng = parseFloat(value.longtitude)
        list.position = position
        list.title = value.name
        list.address = value.address
        arrList[key] = list
      });
      this.markers = arrList
    }
  }
};
</script>

<style scoped lang="scss">
h3{
  color:#1976d2;
  font-weight: 400;
}
ul li{
  list-style: none;
}
.w-60{
  width: 60%;
}
.w-40{
  width: 40%;
}
</style>
