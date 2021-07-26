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
    key: 'AIzaSyDoXYw-BR44MRw7yOehi4o6qQrTr4iq_ko',
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
