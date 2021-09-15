export default {
  install (Vue, { eventbus }) {
    if (eventbus === undefined || eventbus.$emit === undefined) {
      throw Error('notification.event.busNotDefined')
    }

    Vue.prototype.$bus = eventbus
  },
}
