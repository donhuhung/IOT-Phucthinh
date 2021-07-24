<template>
  <v-menu :close-on-content-click="false" offset-x right transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon>mdi-theme-light-dark</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-subheader class="text--primary font-weight-black text-uppercase">
        {{ $t('layout.labelTheme') }}
      </v-subheader>
      <div class="d-flex px-4 pb-4">
        <template v-for="(mode, index) in themeModes">
          <v-list-item :key="index"
                       @click="mode.handler"
                       active-class="primary--text" v-bind="mode.option">
            {{ mode.label }}
            <v-icon right>{{ mode.icon }}</v-icon>
          </v-list-item>
        </template>
      </div>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  name: "ThemeDarkLight",
  computed: {
    themeModes() {
      return [
        {
          label: this.$t('layout.darkLabel'),
          icon: 'mdi-white-balance-sunny',
          handler: () => this.setDarkMode(true),
          option: {
            inputValue: this.$vuetify.theme.dark,
          },
        },
        {
          label: this.$t('layout.lightLabel'),
          icon: 'mdi-weather-night',
          handler: () => this.setDarkMode(false),
          option: {
            inputValue: !this.$vuetify.theme.dark,
          },
        },
      ]
    }
  },
  methods: {
    setDarkMode(isDark = false) {
      this.$vuetify.theme.dark = isDark
    }
  }
}
</script>

<style scoped>

</style>
