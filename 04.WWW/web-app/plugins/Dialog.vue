<template>
  <div style="position: fixed; right: 0px; top: 30px;" @click="$emit('confirm')">
    <template v-for="(ms, index) in items">
      <v-alert color="error" :key="index" text>
        {{ message }}
      </v-alert>
    </template>
  </div>
</template>

<script>
export default {
  name: "Dialog",
  props: {
    message: {
      type: String,
    },
  },
  computed: {
    items() {
      return [1]
    }
  }
}
</script>

<style scoped>

</style>
