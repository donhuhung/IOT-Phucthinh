import Vue from 'vue'
import Vuex, {createLogger} from 'vuex'
import modules from './modules'

const logger = process.env.NODE_ENV === 'production' ? () => {
} : createLogger()
Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules,
  plugins: [logger],
})
