import Vue from 'vue';
import VueI18n from 'vue-i18n';
import store from '../store'
Vue.use(VueI18n);
const i18n = new VueI18n({
  locale: store.state.i18n.locale,
  fallbackLocale: 'vi',
  messages: {
    en: require(`../locales/en.json`),
    vi: require(`../locales/vi.json`),
  },
})
export default i18n
