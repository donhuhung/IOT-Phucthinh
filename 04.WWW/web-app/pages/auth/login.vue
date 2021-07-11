<template>
  <div class="sm:w-2/3 w-full lg:px-0 mx-auto">
    <v-card :loading="submitting" elevation="0">
      <v-card-text>
        <form @submit.prevent="submit" class="space-y-2">
          <img class="text-center m-auto" loading="lazy" src="~/assets/img/logo-phuc-thinh-22.png" alt=""/>
          <p class="text-center title-welcome p-5" style="color: #007BFF">
            {{ $t('layout.login') }}
          </p>
          <div class="pb-2 pt-4">
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
          <div class="text-left">
            <router-link to="/auth/forgot-password">
              {{ $t('layout.ForgotPassword') }}?
            </router-link>
          </div>
          <v-btn rounded
                 color="primary"
                 depressed
                 type="submit"
                 :loading="submitting"
                 :disabled="submitting">
            {{ submitting ? 'submitting...' : $t('layout.login') }}
          </v-btn>
        </form>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
  layout: 'auth',
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
      const {groupUser} = this
      let factoryID = this.user.factory.id;
      return groupUser === 'super_admin_app' ? '/factory' : '/factory/' + factoryID + '/overview'
    },
  },
  methods: {
    ...mapActions("auth", ["login"]),
    async submit(e) {
      e.preventDefault();
      if (this.submitting) {
        return
      }
      const {ip_factory, username, password} = this
      try {
        if (ip_factory && username && password) {
          this.submitting = true
          await this.login({ip_factory, username, password});
          if (this.isLoggedIn) {
            this.authSuccess()
          }
        }
      } catch (err) {
        if (err.response) {
          const {data = {}} = err.response
          const message = data.message
          this.error_login = message
          this.$nuxt.$emit('notify', message)
          this.$notify({message})
        }
      } finally {
        this.submitting = false
      }
    },
    authSuccess() {
      let path;
      if(this.$route.query['redirect'] !='/')
        path = this.$route.query['redirect']
      else
        path = this.defaultPage
      //const path = this.$route.query['redirect'] || this.defaultPage
      this.$router.replace({path})
    },
  }
}
</script>

<style scoped>

</style>
