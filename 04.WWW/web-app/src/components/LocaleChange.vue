<template>
  <v-menu transition="slide-y-transition" offset-x right>
    <template v-slot:activator="{on}">
      <div v-on="on" class="d-flex align-center justify-center cursor-pointer px-2" :v-ripple="true">
        <img class="d-block" width="20" :src="languages.lan.icon" alt=""/>
      </div>
    </template>
    <v-card>
      <v-list dense>
        <v-subheader class="text--primary font-weight-black text-uppercase">
          TRANSLATIONS
        </v-subheader>
        <template v-for="(lan, index) in languages.locales">
          <v-list-item dense :key="index"
                       @click="lan.handler"
                       active-class="primary--text"
                       v-bind="lan.option">
            <v-list-item-avatar>
              <img :src="lan.icon" alt=""/>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                {{ lan.label }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  name: "LocaleChange",
  computed: {
    languages() {
      const locale = this.$store.getters['i18n/locale']
      const locales = [
        {
          label: 'Vietnamese',
          shortLabel: 'Vi',
          icon: '/assets/img/icon/vi.png',
          handler: () => {
            this.$store.commit('i18n/setLocale', 'vi')
            this.$i18n.locale = 'vi'
          },
          option: {
            inputValue: locale === 'vi'
          }
        },
        {
          label: 'English',
          icon: '/assets/img/icon/en.png',
          shortLabel: 'En',
          handler: () => {
            this.$store.commit('i18n/setLocale', 'en')
            this.$i18n.locale = 'en'
          },
          option: {
            inputValue: locale === 'en'
          }
        },
      ]
      const lan = locale === 'en' ? locales[1] : locales[0]
      return {locales, lan}
    }
  },
}
</script>

<style scoped>

</style>
