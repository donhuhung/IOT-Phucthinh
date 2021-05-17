<template>
  <div class="w-full bg-white dark:bg-gray-700 flex items-center h-14 justify-end px-4 py-2">
    <div>
      <TheSearchBox/>
    </div>
    <ThumbAccount/>
  </div>
</template>

<script>
import ThumbAccount from "./ThumbAccount";
import TheSearchBox from "./TheSearchBox";

export default {
  name: "TheTopBar",
  components: {TheSearchBox, ThumbAccount}
}
</script>

<style scoped>

</style>
