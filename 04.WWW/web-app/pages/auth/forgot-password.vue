<template>
  <div>
    <form action="" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
      <p class="text-left">Forgot Password</p>
      <div class="pb-2 pt-4">
        <input type="text" name="email" id="email" placeholder="Email"
               class="block w-full p-4 text-lg rounded-sm bg-black">
      </div>
      <div class="text-right text-gray-400 hover:underline hover:text-gray-100">
        <router-link to="/auth/login">Login?</router-link>
      </div>
      <div class="px-4 pb-2 pt-4">
        <button @click="$store.commit('auth/authSuccess', {token: 1})"
                class="uppercase block w-full p-2 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
          Submit
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

</style>
