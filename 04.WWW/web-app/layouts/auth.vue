<template>
  <v-app>
    <div>
      <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex hidden bg-gray-500 bg-no-repeat bg-cover bg-center relative items-center"
             style="background-image: url(https://www.htechsolution.vn/phucthinh/images/banner-login.png); width: 50%;">
          <div class="w-full px-24 z-10">
            <h1 class="text-5xl font-bold text-left tracking-wide">Phúc Thịnh</h1>
            <p class="text-3xl my-4">System Management IOT</p>
          </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
             style="background-color: #F5F6FA;">
          <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center"
               style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
          </div>
          <div class="w-full py-6 z-20">
            <Nuxt/>
          </div>
        </div>
      </section>
    </div>
  </v-app>
</template>

<script>
export default {
  middleware({ store, redirect, route }) {
    if (store.getters['auth/isLoggedIn']) {
      let path = route.query['redirect'] || '/factory'
      return redirect(path)
    }
  },
}
</script>

<style scoped>
</style>
