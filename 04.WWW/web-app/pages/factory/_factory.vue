<template>
  <div>
    <v-app-bar app dense>
      <v-app-bar-nav-icon>
        <v-icon>mdi-home</v-icon>
      </v-app-bar-nav-icon>
      <v-app-bar-title class="primary--text">{{ factory.name }}</v-app-bar-title>
      <v-spacer/>
      <v-toolbar-items>
        <template v-for="(nav, index) in navs">
          <v-btn active-class="text-primary"
                 :key="index"
                 class="link_item"
                 :to="`/factory/${$route.params.factory}/${nav.to.path}`" depressed>
            <img :src="`${nav.icon}`" width="15" alt="" class="icon_nav"/>
            {{ $t(nav.label) }}
          </v-btn>
        </template>
      </v-toolbar-items>
    </v-app-bar>
    <div>
      <nuxt-child/>
    </div>
  </div>
</template>

<script>

import jsonMixin from "../../mixins/jsonMixin";
import {mapGetters} from 'vuex'

export default {
  mixins: [jsonMixin],
  data() {
    return {
      navs: []
    }
  },
  computed: {
    ...mapGetters({
      isSuperAdminApp: 'auth/isSuperAdminApp',
      factory: 'auth/factory',
    }),

  },
  async mounted() {
    const navs = await this.fetchNavs()
    this.navs = navs.filter((nav) => nav.inFactory)
  }
}
</script>

<style lang="scss">
.nav-detail-factory {
  //position: sticky;
  //top: 60px;
  border-right: solid 1px rgba(0, 0, 0, 0.12);
}

.content-detail-factory {
  //border-left: solid 1px rgba(0, 0, 0, 0.12);
}

.link_item {
  .icon_nav {
    display: block;
    margin-right: 10px;
  }

  .v-btn__content {
    letter-spacing: 0px;
    text-transform: capitalize;
  }
}
</style>
