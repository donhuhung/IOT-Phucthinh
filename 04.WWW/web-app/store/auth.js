import { getSESSION, removeSESSION, SESSION, setSESSION } from '~/helpers/sessions'
export const state = () => {
  return {
    status: '',
    token: getSESSION(SESSION.TOKEN) || '',
    user: null,
  }
}

export const getters = {
  isLoggedIn: (state) => !!state.token,
  authStatus: (state) => state.status,
  user: (state) => state.user,
  token: (state) => state.token,
}

export const actions = {
  getUser({ commit }) {
    return new Promise((resolve, reject) => {

    })
  },
  login({ commit }, user) {
    return new Promise((resolve, reject) => {
      commit('authRequest')
    })
  },
  logout({ commit }) {
    return new Promise((resolve) => {
      commit('logout')
      resolve()
    })
  },
}

// mutations
export const mutations = {
  authRequest(state) {
    state.status = 'loading'
  },
  authSuccess(state, { token, user }) {
    state.status = 'success'
    state.token = token
    state.user = user
    this.$axios.setToken(`JWT ${token}`)
    // this.$axios.defaults.headers.common['Authorization'] = `JWT ${token}`
    setSESSION(SESSION.TOKEN, token)
  },
  authError(state) {
    state.status = 'error'
  },
  logout(state) {
    state.status = ''
    state.token = ''
    removeSESSION(SESSION.TOKEN)
    this.$axios.setToken('')
  },
}

