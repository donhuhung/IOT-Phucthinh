import axios from 'axios'
import store from '../store'
import router from '../router'

const instance = axios.create({
  baseURL: process.env.VUE_APP_API_HOST
})
instance.interceptors.request.use(function (config) {
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
  return config;
}, function (error) {
  return Promise.reject(error);
});
// Add a response interceptor
instance.interceptors.response.use(function (response) {
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
    `%c${baseURL}${instance.getUri(response.config)} ${executionTime}ms`,
    `color: ${color}; font-size: x-large`
  )
  return response;
}, function (error) {
  console.error('ERR', error.response.status)
  const response = error.response
  console.error(response)
  if (response.status === 401) {
    store.dispatch('auth/logout').then(() => {
      let query = {redirect: router.currentRoute.fullPath}
      router.replace({path: '/auth/login', query})
    })
  }
  return Promise.reject(error);
});


export default instance

