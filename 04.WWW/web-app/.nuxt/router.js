import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _01f067b6 = () => interopDefault(import('..\\pages\\chart.vue' /* webpackChunkName: "pages/chart" */))
const _7cab0f6c = () => interopDefault(import('..\\pages\\dashboard.vue' /* webpackChunkName: "pages/dashboard" */))
const _87fd8a3c = () => interopDefault(import('..\\pages\\factory.vue' /* webpackChunkName: "pages/factory" */))
const _29b5116f = () => interopDefault(import('..\\pages\\maps.vue' /* webpackChunkName: "pages/maps" */))
const _45f6515e = () => interopDefault(import('..\\pages\\overview.vue' /* webpackChunkName: "pages/overview" */))
const _3a512512 = () => interopDefault(import('..\\pages\\sensor.vue' /* webpackChunkName: "pages/sensor" */))
const _9fcdf5b0 = () => interopDefault(import('..\\pages\\setting.vue' /* webpackChunkName: "pages/setting" */))
const _0991d635 = () => interopDefault(import('..\\pages\\auth\\forgot-password.vue' /* webpackChunkName: "pages/auth/forgot-password" */))
const _0fb6ff99 = () => interopDefault(import('..\\pages\\auth\\login.vue' /* webpackChunkName: "pages/auth/login" */))
const _738e1eaa = () => interopDefault(import('..\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/chart",
    component: _01f067b6,
    name: "chart"
  }, {
    path: "/dashboard",
    component: _7cab0f6c,
    name: "dashboard"
  }, {
    path: "/factory",
    component: _87fd8a3c,
    name: "factory"
  }, {
    path: "/maps",
    component: _29b5116f,
    name: "maps"
  }, {
    path: "/overview",
    component: _45f6515e,
    name: "overview"
  }, {
    path: "/sensor",
    component: _3a512512,
    name: "sensor"
  }, {
    path: "/setting",
    component: _9fcdf5b0,
    name: "setting"
  }, {
    path: "/auth/forgot-password",
    component: _0991d635,
    name: "auth-forgot-password"
  }, {
    path: "/auth/login",
    component: _0fb6ff99,
    name: "auth-login"
  }, {
    path: "/",
    component: _738e1eaa,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
