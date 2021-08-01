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
        name: 'account-info',
        components: {
          'local-menu': () => import( '../components/local-menu/LocalMenuCustomer'),
          'default': () => import('../pages/account-info'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/account-password',
        name: 'account-password',
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'default': () => import('../pages/account-password'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
        },
      },
      {
        path: '/customers/:customer/factory/:factory',
        name: 'factory-detail',
        meta: {
          breadcrumb: 'Detail'
        },
        components: {
          'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
          'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
          'default': () => import('../pages/factory'),
        },
        children: [
          {
            path: '/customers/:customer/factory/:factory/device',
            name: 'factory-device',
            meta: {
              breadcrumb: 'MONITORING & CONTROLLING DEVICES'
            },
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/device'),
            },
          },
          {
            path: '/customers/:customer/factory/:factory/statistic',
            name: 'factory-statistic',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/statistic'),
            },
            meta: {
              breadcrumb: 'STATISTIC'
            },
            children: [
              {
                path: 'electrical',
                exact: true,
                name: 'statistic-electrical',
                components: {
                  'local-panel': () => import('../components/panels/PanelStatistic'),
                  'default': () => import('../pages/factory/statistic/electrical'),
                },
              },
              {
                path: 'flowmeter',
                exact: true,
                name: 'statistic-flowmeter',
                components: {
                  'local-panel': () => import('../components/panels/PanelStatistic'),
                  'default': () => import('../pages/factory/statistic/flowmeter'),
                },
              },
              {
                path: 'schemical',
                exact: true,
                name: 'statistic-chemical',
                components: {
                  'local-panel': () => import('../components/panels/PanelStatistic'),
                  'default': () => import('../pages/factory/statistic/schemical'),
                },
              },

            ]
          },
          {
            path: '/customers/:customer/factory/:factory/report',
            name: 'factory-report',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/report'),
            },
            meta: {
              breadcrumb: 'REPORT'
            },
          },
          {
            path: '/customers/:customer/factory/:factory/maintenance',
            name: 'factory-maintenance',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/maintenance'),
            },
            meta: {
              breadcrumb: 'Maintenance'.toUpperCase()
            },
          },
          {
            path: '/customers/:customer/factory/:factory/maps',
            name: 'customer-maps',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import( '../pages/factory/maps'),
            },
            meta: {
              breadcrumb: 'Maps'.toUpperCase()
            },
          },
          {
            path: '/customers/:customer/factory/:factory/overview',
            name: 'factory-overview',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import( '../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/overview'),
            },
            meta: {
              breadcrumb: 'OVERVIEW'
            },
          },
          {
            path: '/customers/:customer/factory/:factory/sensor',
            name: 'factory-sensor',
            components: {
              'local-menu': () => import('../components/local-menu/LocalMenuCustomer'),
              'local-toolbar': () => import('../components/local-toolbar/toolbar-factory'),
              'default': () => import('../pages/factory/sensor'),
            },
            meta: {
              breadcrumb: 'MONITORING & SCALLING SENSOR'
            },
          },
        ]
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
