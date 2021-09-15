import store from '../../store'
export default (to, _, next) => {
  // todo: check if login isLoggedIn
  if(!store.getters['auth/isLoggedIn']) {
    let query = { redirect: to.fullPath }
    return next({
      path: '/auth/login',
      query,
    })

  }
  next()
}

