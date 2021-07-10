<template>
  <div class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
    <v-card :loading="submitting" elevation="0">
      <v-card-text>
        <img class="text-center m-auto" loading="lazy" src="~/assets/img/logo-phuc-thinh-22.png" alt=""/>
        <v-form @submit.prevent="submit">
          <p class="text-center title-welcome p-5" style="color: #007BFF">
            {{ $t('layout.ForgotPassword') }}
          </p>
          <div class="pb-2 pt-4">
            <v-text-field label="Email" color="primary"/>
          </div>
          <div class="text-left text-gray-400 hover:underline hover:text-gray-100">
            <router-link to="/auth/login">
              {{ $t('layout.login') }}?
            </router-link>
          </div>
          <v-btn type="submit"
                 depressed
                 rounded
                 :loading="submitting"
                 :disabled="submitting"
                 color="primary">
            {{ $t('layout.submit') }}
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "forgot-password",
  layout: 'auth',
  data() {
    return {
      submitting: false
    }
  },
  methods: {
    submit() {
      return false
    }
  }
}
</script>

<style scoped>

</style>
