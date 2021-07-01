<template>
  <div>
    <form @submit.prevent="submit" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
      <!-- App Logo -->
      <img class="text-center m-auto" loading="lazy" src="~/assets/img/logo-phuc-thinh-22.png" alt=""/>
      <p class="text-center title-welcome p-5" style="color: #007BFF">
        {{ $t('layout.login')}}
      </p>
      <div class="pb-2 pt-4">
        <input type="text" name="ip-factory" id="ip-factory" v-model="ip_factory" :placeholder="$t('layout.IpFactory')"
               class="block w-full p-4 text-lg rounded-sm bg-white text-center">
      </div>
      <div class="pb-2 pt-4">
        <input class="block w-full p-4 text-lg rounded-sm bg-white text-center"
               name="username" type="text" v-model="username"
               :placeholder="$t('layout.UserName')">
      </div>
      <div class="pb-2 pt-4">
        <input class="block w-full p-4 text-lg rounded-sm bg-white text-center"
               type="password"
               name="password" id="password" v-model="password"
               :placeholder="$t('layout.password')">
      </div>
      <div class="flex justify-between mt-4">
        <div>
          <input name="remember-me" id="remember-me" type="checkbox">
          <span>Remember me</span>
        </div>
        <div>
          <router-link to="/auth/forgot-password">
            {{ $t('layout.ForgotPassword') }}?
          </router-link>
        </div>
      </div>
      <div class="px-4 pb-2 pt-4 mt-5">
        <button type="submit"
                class="btn-login uppercase block w-full p-2 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
          {{ submitting ? 'submitting...' : $t('layout.login') }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
  layout: 'auth',
  data() {
    return {
      username: '',
      password: '',
      ip_factory: '',
      click_submit: false,
      error_login:false,
      submitting: false,
    }
  },
  methods: {
    ...mapActions("auth", ["login"]),
    async submit(e) {
      e.preventDefault();
      if(this.submitting) {
        return
      }
      this.click_submit = true;
      let ip_factory = this.ip_factory;
      let username = this.username;
      let password = this.password;
      try {
        this.submitting = true
        let loggedIn = await this.login({ip_factory,username,password});
      }finally {
        this.submitting = false
      }


    }
  }
}
</script>

<style scoped>
.btn-login{
  background-color: #007BFF;
  color:#fff;
}
span{
  color:#686868;
}
#remember-me{
  height: auto;
}
</style>
