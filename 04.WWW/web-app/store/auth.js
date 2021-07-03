import { getSESSION, removeSESSION, SESSION, setSESSION } from '~/helpers/sessions'
import { login } from "../api/auth";


export const state = () => {
  return {
    status: '',
    token: getSESSION(SESSION.TOKEN) || '',
    user: getSESSION(SESSION.USER) || '',
    groupUser:getSESSION(SESSION.GROUPUSER) || '',
  }
}

export const getters = {
  isLoggedIn: (state) => !!state.token,
  authStatus: (state) => state.status,
  user: (state) => state.user,
  token: (state) => state.token,
  groupUser: (state) => state.groupUser,
  isSuperAdminApp: (state) => state.groupUser === 'super_admin_app',
  // isSuperAdminApp: (state) => false
}

export const actions = {
  getUser({ commit }) {
    return new Promise((resolve, reject) => {

    })
  },
  login,
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
  authSuccess(state, data) {
    state.status = 'success'
    state.token = data.access_token
    state.user = data
    state.groupUser = data.group[0].code
    //this.$axios.setToken(`Bearer ${token}`)
     this.$axios.defaults.headers.common['Authorization'] = `Bearer ${data.access_token}`
    setSESSION(SESSION.TOKEN, data.access_token)
    setSESSION(SESSION.GROUPUSER,data.group[0].code)
    setSESSION(SESSION.USER,data)
  },
  authError(state) {
    state.status = 'error'
  },
  logout(state) {
    state.status = ''
    state.token = ''
    state.groupUser = ''
    removeSESSION(SESSION.TOKEN)
    removeSESSION(SESSION.GROUPUSER)
    removeSESSION(SESSION.USER)
    this.$axios.setToken('')
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
