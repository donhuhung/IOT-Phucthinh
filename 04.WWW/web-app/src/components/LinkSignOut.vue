<template>
  <div>
    <slot name="activator" :on="handleSignOut">
      <v-btn @click="handleSignOut" icon>
        <v-icon small>
          mdi-logout
        </v-icon>
      </v-btn>
    </slot>
    <v-dialog persistent max-width="320" v-model="uiDialog">
      <v-card>
        <v-card-title class="text-h6">
          {{ $t('layout.confirmSignOutLabel') }}
        </v-card-title>
        <v-card-text>
          {{ $t('layout.confirmSignOutDescription') }}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn :disabled="submitting"
            color="grey darken-1"
            text
            @click="uiDialog = false"
          >
            {{ $t('layout.labelCancel') }}
          </v-btn>
          <v-btn :loading="submitting" :disabled="submitting"
            color="blue darken-1"
            text
            @click="signOut"
          >
            {{ $t('layout.signOut') }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {logout} from "../api/auth";

export default {
  name: "LinkSignOut",
  data() {
    return {
      uiDialog: false,
      submitting: false,
    }
  },
  methods: {
    async handleSignOut() {
      this.uiDialog = true
    },
    async signOut() {
      this.submitting = true
      try {
        await logout()
        this.$store.commit('auth/logout')
        this.redirectLogin()
      } catch (e) {
        this.$notify({ message: e.message, type: 'error'})
      }finally {
        this.submitting = false
      }
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
