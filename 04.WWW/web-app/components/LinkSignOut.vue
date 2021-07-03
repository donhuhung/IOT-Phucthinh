<template>
  <div>
    <slot>
      <v-btn @click="handleSignOut" icon>
        <v-icon small>
          fa-sign-out-alt
        </v-icon>
      </v-btn>
    </slot>
    <v-dialog persistent max-width="320" v-model="uiDialog">
      <v-card>
        <v-card-title class="text-h6">
          Đăng xuất phiên làm việc?
        </v-card-title>
        <v-card-text>
          Let Google help apps determine location.
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey darken-1"
            text
            @click="uiDialog = false"
          >
            Hủy bỏ
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="signOut"
          >
            Đăng xuất
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
  name: "LinkSignOut",
  data() {
    return {
      uiDialog: false,
    }
  },
  methods: {
    ...mapActions({
      logout: 'auth/logout',
    }),
    async handleSignOut() {
      this.uiDialog = true
    },
    async signOut() {
      await this.logout()
      this.redirectLogin()
    },
    redirectLogin() {
      let query = {redirect: this.$route.fullPath}
      this.$router.replace({path: '/auth/login', query})
    },
  }
}
</script>

<style scoped>

</style>
