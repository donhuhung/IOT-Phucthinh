import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import './plugins'
import '@/styles/main.scss'
import vuetify from './plugins/vuetify'
import i18n from './plugins/i18n'
import * as VueGoogleMaps from 'vue2-google-maps'
import VueHtmlToPaper from 'vue-html-to-paper'


Vue.config.productionTip = false
Vue.use(VueGoogleMaps, {
  load: {
    key: process.env.VUE_APP_GOOGLE_APIKEY,
    libraries: 'places,drawing', // This is required if you use the Autocomplete plugin
  },
})
const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css',
    'https://ptewater.com/css/print.css'
  ],
  "windowTitle": "PTEWATER REPORT"
}
Vue.use(VueHtmlToPaper,options);

new Vue({
  store,
  router,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app')
