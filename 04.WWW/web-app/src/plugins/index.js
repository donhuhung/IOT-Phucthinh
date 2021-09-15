import Vue from 'vue'
import notify from './notify'
import bus from './bus'
import './googleMaps'

const eventbus = new Vue()
// TODO: add store checking
Vue.use(bus, { eventbus })
Vue.use(notify, { eventbus })
