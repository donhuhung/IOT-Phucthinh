import colors from 'vuetify/es5/util/colors'
require('dotenv').config()
export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,
  router: {
    mode: 'hash'
  },

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'PhucThinh-SPA',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'stylesheet', crossorigin: 'anonymous',
        href: 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', integrity: "sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" },
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '~/assets/styles/main.scss'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/https',
    '~/plugins/i18n',
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    ['@nuxtjs/vuetify', { /* module options */ }]
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios'
  ],
  vuetify: {
    customVariables: ['~/assets/styles/variables.scss'],
    treeShake: true,
    icons: {
      iconfont: 'fa',
    },
    theme: {
      // disable: true,
      // dark: true,
      dark: false,
      themes: {
        light: {
          primary: '#6d42c7',
        },
        dark: {
          primary: '#6d42c7',
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3,
        },
      },
    },
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },
  axios: {
    // baseURL: '/',
    baseURL: process.env.VUE_APP_API_HOST,
    // proxy: process.env.NODE_ENV !== 'production' // enable proxy for development mode only,
    // retry: { retries: 3 }
  },
}
