import _find from 'lodash/find';
export const state = () => ({
  locales: [
    { value: 'vi', label: 'VI' },
    { value: 'en', label: 'EN' },
  ],
  locale: 'vi',
})
export const mutations = {
  setLocale(state, locale) {
    const isLocale = _find(state.locales, { value: locale })
    if (isLocale) {
      state.locale = locale
    }
  },
};
