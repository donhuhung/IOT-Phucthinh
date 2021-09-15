export default  {
  install(Vue, { eventbus }) {
    if (eventbus === undefined || eventbus.$emit === undefined) {
      throw Error('Expecting eventbus to be passed as an option to websocket plugin')
    }
    Vue.prototype.$notify = (res) => {
      eventbus.$emit('notify', res)
    }
  }
}

