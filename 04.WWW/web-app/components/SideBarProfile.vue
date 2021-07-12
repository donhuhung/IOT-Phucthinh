<template>
  <v-list dense>
    <v-list-item class="px-2">
      <v-list-item-avatar>
        <v-img src="/img/logo-phuc-thinh-22.png"></v-img>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="text-h6">
          {{user.name}}
        </v-list-item-title>
        <v-list-item-subtitle>
          {{ $t('layout.msgWelcome') }},
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
  name: "SideBarProfile",
  computed: {
    ...mapGetters(
      {
        isLoggedIn:'auth/isLoggedIn',
        user:'auth/user',
        token:'auth/token',
        groupUser:'auth/groupUser'
      }),
  },
}
</script>

<style scoped>

</style>
