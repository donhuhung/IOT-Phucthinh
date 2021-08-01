<template>
  <div>
    <template v-if="getting">
      <v-skeleton-loader type="table" width="690px"/>
    </template>
    <template v-else>
      <div>
        {{ report }}
      </div>
    </template>
  </div>
</template>

<script>
import https from "../plugins/https";

export default {
  name: "ReportTemplate",
  props: {
    endPoint: {
      type: String,
      default: () => '/api/v1/report/electrical',
    }
  },
  data() {
    return {
      getting: false,
      report: {}
    }
  },
  async mounted() {
    await this.fetchReport()
  },
  methods: {
    async fetchReport() {
      const {endPoint} = this
      const {params: {factory}} = this.$route
      try {
        this.getting = true
        const res = await https.post(endPoint, {
          factory_id: factory,
          from_date: '01-04-2021',
          to_date: '28-04-2021'
        })
        console.error(res)
        this.report = res.data.data
      } finally {
        this.getting = false
      }
    }
  }
}
</script>

<style scoped>

</style>
