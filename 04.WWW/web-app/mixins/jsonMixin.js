export default {
  methods: {
    async fetchNavs() {
      const res = await fetch('/json/navs.json')
      return await res.json()
    },
    async fetchFactory() {
      const res = await fetch('/json/factory.json')
      return await res.json()
    },
  }
}
