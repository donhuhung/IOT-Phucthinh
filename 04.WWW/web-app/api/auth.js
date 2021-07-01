async function login( { commit }, data) {
  let form = new FormData();
  form.append("ip_factory", data.ip_factory);
  form.append("username", data.username);
  form.append("password", data.password);
  try {
    commit("authRequest");
    const res = await this.$axios.$post('/api/v1/user/login', form);
    commit("authSuccess", res.data);
  }catch (e) {
    commit("authError", e);
  }finally {

  }
}

async function forgotPassword(data) {
  let form = new FormData();
  form.append("email", data.email);
  return await this.$axios.$post('/api/v1/user/forgotPassword', form);
}

async function resetPassword(data) {
  let form = new FormData();
  form.append("reset_password_code", data.reset_password_code);
  form.append("new_password", data.new_password);
  return await this.$axios.$post('/api/v1/user/resetPassword', form);
}

async function changePassword(data) {
  let form = new FormData();
  form.append("current_password", data.current_password);
  form.append("new_password", data.new_password);
  return await this.$axios.$post('/api/v1/user/changePassword', form);
}

async function logout(code) {
  return await this.$axios.$get('/api/v1/user/logout');
}

async function updateAccount(data) {
  let form = new FormData();
  form.append("username", data.username);
  form.append("email", data.email);
  form.append("gender", data.gender);
  form.append("dob", data.dob);
  form.append("zil_address", data.zil_address);
  form.append("eth_address", data.eth_address);
  return await this.$axios.$post('/api/v1/user/edit', form);
}

export {
  login,
  logout,
  forgotPassword,
  resetPassword,
  changePassword
};
