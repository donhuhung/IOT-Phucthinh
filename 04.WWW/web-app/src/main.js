import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import './plugins'
import '@/styles/main.scss'
import VueGoogleMap from 'vuejs-google-maps'
import 'vuejs-google-maps/dist/vuejs-google-maps.css'
import vuetify from './plugins/vuetify'
import i18n from './plugins/i18n'

Vue.config.productionTip = false

Vue.use(VueGoogleMap, {
  load: {
    apiKey: "AIzaSyDoXYw-BR44MRw7yOehi4o6qQrTr4iq_ko",
    v: '3.',
    libraries: ["places"] // necessary for places input
  }
});

new Vue({
  store,
  router,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app')
