import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import './plugins'
import '@/styles/main.scss'
import vuetify from './plugins/vuetify'
import i18n from './plugins/i18n'
import * as VueGoogleMaps from 'vue2-google-maps'


Vue.config.productionTip = false
Vue.use(VueGoogleMaps, {
  load: {
    key: process.env.VUE_APP_GOOGLE_APIKEY,
    libraries: 'places,drawing', // This is required if you use the Autocomplete plugin
  },
})

new Vue({
  store,
  router,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app')
