<template>
  <div>
    <form action="" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
      <p class="text-left">Login</p>
      <div class="pb-2 pt-4">
        <input type="text" name="email" id="email" placeholder="IP Factory"
               class="block w-full p-4 text-lg rounded-sm bg-black">
      </div>
      <div class="pb-2 pt-4">
        <input class="block w-full p-4 text-lg rounded-sm bg-black"
               name="password"
               placeholder="Username">
      </div>
      <div class="pb-2 pt-4">
        <input class="block w-full p-4 text-lg rounded-sm bg-black"
               type="password"
               name="password" id="password"
               placeholder="Password">
      </div>
      <div class="text-right text-gray-400 hover:underline hover:text-gray-100">
        <router-link to="/auth/forgot-password">Forgot your password?</router-link>
      </div>
      <div class="px-4 pb-2 pt-4">
        <button @click="$store.commit('auth/authSuccess', {token: 1})"
                class="uppercase block w-full p-2 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
          sign in
        </button>
      </div>
      <div class="p-4 text-center right-0 left-0 flex justify-center space-x-4 mt-16 ">
        <a href="#">

        </a>
        <a href="#">

        </a>
        <a href="#">

        </a>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  layout: 'auth'
}
</script>

<style scoped>

</style>
