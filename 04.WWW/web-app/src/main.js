import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import './plugins'
import '@/styles/main.scss'
import vuetify from './plugins/vuetify'
import i18n from './plugins/i18n'

Vue.config.productionTip = false

new Vue({
  store,
  router,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app')
