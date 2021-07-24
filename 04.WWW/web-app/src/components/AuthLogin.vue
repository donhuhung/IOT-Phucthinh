<template>
  <v-card :loading="submitting" elevation="20" width="350px" class="px-4 pb-4">
    <form @submit.prevent="submit">
      <v-card-title class="justify-center">
        <h3>{{ $t('layout.login') }}</h3>
      </v-card-title>
      <v-card-text>
        <div class="">
          <v-text-field v-model="ip_factory"
                        type="text"
                        :label="$t('layout.IpFactory')"/>
          <v-text-field v-model="username"
                        type="text"
                        :label="$t('layout.UserName')"/>
          <v-text-field v-model="password"
                        type="password"
                        :label="$t('layout.password')"/>
        </div>
        <!--        <div class="text-left">
                  <router-link to="/auth/login">
                    {{ $t('layout.ForgotPassword') }}?
                  </router-link>
                </div>-->
        <v-btn color="primary"
               depressed
               block
               type="submit"
               :loading="submitting"
               :disabled="submitting">
          {{ submitting ? 'submitting...' : $t('layout.login') }}
        </v-btn>
        <v-divider />
      </v-card-text>
    </form>
  </v-card>
</template>

<script>
import {mapGetters} from 'vuex';
import {login} from "../api/auth";

export default {
  name: "AuthLogin",
  data() {
    return {
      username: 'phucthinh@gmail.com',
      password: '123456789',
      ip_factory: '197.168.0.12',
      error_login: false,
      submitting: false,
    }
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'auth/isLoggedIn',
      user: 'auth/user',
      token: 'auth/token',
      groupUser: 'auth/groupUser'
    }),
    defaultPage() {
      // const {groupUser} = this
      // let factoryID = this.user.factory.id;
      // return groupUser === 'super_admin_app' ? '/factory' : '/factory/' + factoryID + '/overview'
      return '/'
    },
  },
  methods: {
    async submit(e) {
      e.preventDefault();
      if (this.submitting) {
        return
      }
      const {ip_factory, username, password} = this
      try {
        if (ip_factory && username && password) {
          this.submitting = true
          const res = await login({ip_factory, username, password})
          this.$store.commit("auth/authSuccess", res.data.data);
          this.$notify(res)
          this.authSuccess()
        }
      } catch (err) {
        if (err.response) {
          const {data = {}} = err.response
          const message = data.message
          this.error_login = message
          console.error(message)
          this.$notify({message})
        }
      } finally {
        this.submitting = false
      }
    },
    authSuccess() {
      const path = this.$route.query['redirect'] || this.defaultPage
      this.$router.replace({path})
    },
  }
}
</script>

<style scoped lang="scss">

</style>
