import store from '../../store'
export default (to, _, next) => {
  console.error(process.env.VUE_APP_TITLE)
  // todo: check if login isLoggedIn
  if (store.getters['auth/isLoggedIn']) {
    let path = to.query['redirect'] || '/'
    return next(path)
  }
  next()
}

