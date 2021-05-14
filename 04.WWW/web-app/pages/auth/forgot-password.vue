<template>
  <div>
    <img class="text-center m-auto" loading="lazy" src="~/assets/img/logo-phuc-thinh-22.png" alt=""/>
    <form action="" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
      <p class="text-center title-welcome p-5" style="color: #007BFF">
        {{ $t('layout.ForgotPassword') }}
      </p>
      <div class="pb-2 pt-4">
        <input type="text" name="email" id="email" placeholder="Email"
               class="block w-full p-4 text-lg rounded-sm bg-white text-center">
      </div>
      <div class="text-left pl-4 text-gray-400 hover:underline hover:text-gray-100 p-3">
        <router-link to="/auth/login">
          {{ $t('layout.login') }}?</router-link>
      </div>
      <div class="px-4 pb-2 pt-4">
        <button @click="$store.commit('auth/authSuccess', {token: 1})"
                class="btn-submit uppercase block w-full p-2 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
          {{ $t('layout.submit') }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "forgot-password",
  layout: 'auth'
}
</script>

<style scoped>
.btn-submit{
  background-color: #007BFF;
  color:#fff;
}
</style>
