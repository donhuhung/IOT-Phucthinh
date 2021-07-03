<template>
  <v-list nav dense>
    <template v-for="(nav, index) in navsCombined">
      <v-list-item link :key="index" :to="`/${nav.to.path}`">
        <v-list-item-icon>
          <v-img :src="`${nav.icon}`"/>
        </v-list-item-icon>
        <v-list-item-title>{{ $t(nav.label) }}</v-list-item-title>
      </v-list-item>
    </template>
  </v-list>
</template>

<script>
import jsonMixin from "../mixins/jsonMixin";
import { mapGetters } from 'vuex'
export default {
  name: "SideBarNavs",
  mixins: [jsonMixin],
  data() {
    return {
      navs: [],
    }
  },
  computed: {
    ...mapGetters({
      isSuperAdminApp:'auth/isSuperAdminApp',
    }),
    navsCombined() {
      const { isSuperAdminApp, navs } = this
      const _filter = (nav) => {
        return isSuperAdminApp ? !nav.inFactory : true
      }
      return navs.filter(_filter)
    },
  },
  async mounted() {
    const navs = await this.fetchNavs()
    this.navs = [...navs]
  }
}
</script>

<style scoped>

</style>
