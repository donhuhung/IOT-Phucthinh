import Vue from 'vue'
import VueRouter from 'vue-router'

import authenticate from './middlewares/authenticate'
import authenticated from "./middlewares/authenticated";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../layouts/main.layout'),
    beforeEnter: authenticated,
    children: [
      {
        path: '',
        components: {
          'default': () => import('../pages/index'),
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
        },
      },
      {
        path: '/customers',
        name: 'customers',
        components: {
          'default': () => import('../pages/cutomers'),
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
        },
      },

      {
        path: '/customers/:customer',
        name: 'customers-customer',
        components: {
          'default': () => import('../pages/_customer'),
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
        },
      },
      {
        path: '/account',
        name: 'account-factory',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'default': () => import('../pages/account'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/account-info',
        name: 'customers-customer-account-info',
        components: {
          'local-menu': () => import( '../components/local-menu/LocalMenuCustomer'),
          'default': () => import('../pages/account-info'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/account-password',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'default': () => import('../pages/account-password'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/device',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/device'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/chart',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/chart'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/report',
        name: 'customers-factory-report',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/report'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/maintenance',
        name: 'customers-factory-maintenance',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/maintenance'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/maps',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import( '../pages/factory/maps'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/overview',
        name: 'customers-customer-account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import( '../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/overview'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory/sensor',
        name: 'customers-customer-sensor',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory/sensor'),
        },
      },


    ]
  },
  {
    path: '/auth',
    name: 'auth',
    meta: {},
    beforeEnter: authenticate,
    component: () => import('../layouts/auth.layout'),
    children: [
      {
        path: '/auth/login',
        name: 'auth-login',
        component: () => import('../pages/auth/login'),
      }
    ]
  },
  {
    path: '*',
    component: () => import('../pages/404.vue')
  },
]

const router = new VueRouter({
  mode: 'history',
  /*base: 'phucthinh',*/
  routes
})

export default router
