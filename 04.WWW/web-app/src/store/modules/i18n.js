import _find from 'lodash/find';
const state = () => ({
  locales: [
    { value: 'vi', label: 'VI' },
    { value: 'en', label: 'EN' },
  ],
  locale: 'vi',
})
const getters = {
  locale: (state) => state.locale
}
const mutations = {
  setLocale(state, locale) {
    const isLocale = _find(state.locales, { value: locale })
    if (isLocale) {
      state.locale = locale
    }
  },
};
export default {
  namespaced: true,
  state,
  getters,
  actions: {},
  mutations,
}
