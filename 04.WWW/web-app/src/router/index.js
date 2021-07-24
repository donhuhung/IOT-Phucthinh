import Vue from 'vue'
import VueRouter from 'vue-router'

import authenticate from './middlewares/authenticate'
import authenticated from "./middlewares/authenticated";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "main.layout" */ '../layouts/main.layout'),
    beforeEnter: authenticated,
    children: [
      {
        path: '',
        components: {
          'default': () => import(/* webpackChunkName: "Home" */ '../pages/index'),
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
        },
      },
      {
        path: '/customers',
        name: 'customers',
        components: {
          'default': () => import(/* webpackChunkName: "customers" */ '../pages/cutomers'),
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
        },
      },

      {
        path: '/customers/:customer',
        name: 'customers-customer',
        components: {
          'default': () => import(/* webpackChunkName: "customers-customer" */ '../pages/_customer'),
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/account',
        name: 'customers-customer-account',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'default': () => import(/* webpackChunkName: "account" */ '../pages/account'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/account-info',
        name: 'customers-customer-account-info',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'default': () => import(/* webpackChunkName: "account-info" */ '../pages/account-info'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/account-password',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'default': () => import(/* webpackChunkName: "account-password" */ '../pages/account-password'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/device',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
          'default': () => import(/* webpackChunkName: "device" */ '../pages/factory/device'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/chart',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
          'default': () => import(/* webpackChunkName: "chart" */ '../pages/factory/chart'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/maps',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
          'default': () => import(/* webpackChunkName: "maps" */ '../pages/factory/maps'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/overview',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
          'default': () => import(/* webpackChunkName: "overview" */ '../pages/factory/overview'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/sensor',
        name: 'customers-customer-sensor',
        components: {
          'local-menu': () => import(/* webpackChunkName: "customers-local-menu" */ '../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import(/* webpackChunkName: "customers-local-toolbar" */ '../components/local-toolbar/toolbar-factory'),
          'default': () => import(/* webpackChunkName: "sensor" */ '../pages/factory/sensor'),
        },
      },


    ]
  },
  {
    path: '/auth',
    name: 'auth',
    meta: {},
    beforeEnter: authenticate,
    component: () => import(/* webpackChunkName: "auth-layout" */ '../layouts/auth.layout'),
    children: [
      {
        path: '/auth/login',
        name: 'auth-login',
        component: () => import(/* webpackChunkName: "auth-login" */ '../pages/auth/login'),
      }
    ]
  },
  {
    path: '*',
    component: () => import(/* webpackChunkName: "about" */ '../pages/404.vue')
  },
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
