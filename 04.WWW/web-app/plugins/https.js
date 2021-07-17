import axiosRetry from 'axios-retry'
let axios = require('axios').default

export default function (
  {$axios, route, store, redirect, error}) {
  // const source = $axios.CancelToken.source()
  axiosRetry($axios, {retries: 2})
  $axios.onError((errors) => {
    if (errors.response.status === 401) {
      store.dispatch('auth/logout').then(() => {
        console.log('401', route)
        let query = {redirect: route.fullPath}
        redirect({path: '/auth/login', query})
      })
    }
    if (errors.response.status === 500) {

    }
    if (errors.response.status === 403) {
      error({
        message: `Access Permission Denied`,
        statusCode: 403,
      })
    }
  })
  $axios.onRequest((config) => {
    config._requestStartedAt = new Date().getTime()
    if (!config.url.endsWith('/')) {
      config.url = config.url + '/'
    }
    if (store.getters['auth/token']) {
      let token = store.getters['auth/token']
      config.headers.common['Authorization'] = `Bearer ${token}`
    } else {
      // todo
      // config.headers.common['Authorization'] = `Token `
    }
  })
  $axios.onResponse((response) => {
    let executionTime = new Date().getTime() - response.config._requestStartedAt
    let color = 'blue'
    let baseURL =
      response.config.baseURL === '/'
        ? location.origin
        : response.config.baseURL
    if (executionTime > 2000) {
      color = 'red'
    }
    console.info(
      `%c${baseURL}${$axios.getUri(response.config)} ${executionTime}ms`,
      `color: ${color}; font-size: x-large`
    )
  })
  axios = $axios
}
export { axios }


