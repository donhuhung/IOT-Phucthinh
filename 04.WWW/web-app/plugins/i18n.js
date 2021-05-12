import Vue from 'vue';
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);
export default function ({$axios, route, store, redirect, error, app }) {
  app.i18n = new VueI18n({
    locale: store.state.i18n.locale,
    fallbackLocale: 'vi',
    messages: {
      en: require('~/static/locales/en.json'),
      vi: require('~/static/locales/vi.json'),
    },
  });
}
