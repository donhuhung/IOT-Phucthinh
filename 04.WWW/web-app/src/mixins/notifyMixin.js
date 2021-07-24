export default {
  data() {
    return {
      message: undefined,
      showMessage: false,
      type: undefined
    }
  },
  mounted() {
    this.$bus.$on('notify', ({message, type}) => {
      this.message = message
      this.showMessage = true
      this.type = type
    })
  },
}
