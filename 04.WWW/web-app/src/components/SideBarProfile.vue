<template>
  <v-list dense>
    <v-list-item class="px-2">
      <v-list-item-avatar color="primary">
        <v-img src="/img/logo-phuc-thinh-22.png"></v-img>
        <span class="center-abs white--text">{{ String(user.name).substr(0, 1) }}</span>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title>
          {{ user.name }}
        </v-list-item-title>
        <v-list-item-subtitle>
          {{ $t('layout.msgWelcome') }},
        </v-list-item-subtitle>
      </v-list-item-content>
      <v-list-item-action>
        <v-menu offset-y bottom transition="slide-y-transition">
          <template v-slot:activator="{on}">
            <v-icon v-on="on">mdi-dots-vertical</v-icon>
          </template>
          <v-card>
            <v-list dense>
              <template v-for="(item, index) in menu">
                <v-list-item link :key="index" dense :to="`${rootLink}/${item.to}`">
                  <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                  </v-list-item-icon>
                  <v-list-item-title class="pl-0">{{ item.label }}</v-list-item-title>
                </v-list-item>
              </template>
            </v-list>
          </v-card>
        </v-menu>
      </v-list-item-action>
    </v-list-item>
  </v-list>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
  name: "SideBarProfile",
  computed: {
    ...mapGetters(
        {
          isLoggedIn: 'auth/isLoggedIn',
          user: 'auth/user',
          token: 'auth/token',
          groupUser: 'auth/groupUser'
        }),
    menu() {
      return [
        {
          label: 'Xem hồ sơ',
          icon: 'mdi-eye',
          to: 'account'
        },
        {
          label: 'Cập nhật thông tin',
          icon: 'mdi-account-edit',
          to: 'account-info'
        },
        {
          label: 'Thay đổi mật khẩu',
          icon: 'mdi-lock',
          to: 'account-password'
        },

      ]
    },
    rootLink() {
      const {params: {customer}} = this.$route
      return `/customers/${customer}`
    }
  },
}
</script>

<style scoped>

</style>
