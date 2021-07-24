<template>
  <v-snackbar v-model="showMessage"
              class="notify-wrapper"
              top
              right
              content-class="notify-app"
              :dark="$vuetify.theme.dark"
              outlined
              transition="slide-y-transition">
    <v-alert class="mb-0"
             dense
             text :dark="$vuetify.theme.dark"
             :type="type || 'warning'"
    >
      {{ message }}
    </v-alert>
  </v-snackbar>
</template>

<script>
import notifyMixin from "../mixins/notifyMixin";

export default {
  name: "NotifyFlash",
  mixins: [notifyMixin]
}
</script>

<style scoped>

</style>
