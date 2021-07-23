export default {
  methods: {
    async fetchNavs() {
      const res = await fetch('/json/navs.json')
      return await res.json()
    },
  }
}
