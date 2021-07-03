<template>
  <v-row no-gutters>
    <v-col cols="2" v-if="isSuperAdminApp">
      <v-sheet class="nav-detail-factory" height="100%">
        <v-list nav dense>
          <template v-for="(nav, index) in navs">
            <v-list-item link :key="index" :to="`/factory/${$route.params.factory}/${nav.to.path}`">
              <v-list-item-icon>
                <v-img :src="`${nav.icon}`"/>
              </v-list-item-icon>
              <v-list-item-title>{{ $t(nav.label) }}</v-list-item-title>
            </v-list-item>
          </template>
        </v-list>
      </v-sheet>
    </v-col>
    <v-col :col="isSuperAdminApp ? '10' : '12'">
      <v-sheet
        min-height="70vh" class="content-detail-factory">
        <div class="px-2 py-2">
          <nuxt-child/>
        </div>
      </v-sheet>
    </v-col>
  </v-row>
</template>

<script>

import jsonMixin from "../../mixins/jsonMixin";
import { mapGetters } from 'vuex'
export default {
  mixins: [jsonMixin],
  data() {
    return {
      navs: []
    }
  },
  computed: {
    ...mapGetters({
      isSuperAdminApp: 'auth/isSuperAdminApp'
    }),

  },
  async mounted() {
    const navs = await this.fetchNavs()
    this.navs = navs.filter((nav) => nav.inFactory)
  }
}
</script>

<style scoped lang="scss">
.nav-detail-factory {
  //position: sticky;
  //top: 60px;
}
.content-detail-factory {
  border-left: solid 1px rgba(0, 0, 0, 0.12);
}
</style>
