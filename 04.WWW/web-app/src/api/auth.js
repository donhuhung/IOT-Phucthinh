import axios from '../plugins/https'
async function login(data) {
  let form = new FormData();
  form.append("ip_factory", data.ip_factory);
  form.append("username", data.username);
  form.append("password", data.password);
  return await axios.post('/api/v1/user/login', form);
}

async function forgotPassword(data) {
  let form = new FormData();
  form.append("email", data.email);
  return await axios.post('/api/v1/user/forgotPassword', form);
}

async function resetPassword(data) {
  let form = new FormData();
  form.append("reset_password_code", data.reset_password_code);
  form.append("new_password", data.new_password);
  return await axios.post('/api/v1/user/resetPassword', form);
}

async function changePassword(data) {
  let form = new FormData();
  form.append("new_password", data.new_password);
  form.append("confirm_password", data.confirm_password);
  return await axios.post('/api/v1/user/change-password', form);
}

async function logout() {
  return await axios.get('/api/v1/user/logout');
}

async function updateAccount(data) {
  let form = new FormData();
  form.append("name", data.name);
  form.append("email", data.email);
  form.append("gender", data.gender);
  form.append("birthday", data.birthday);
  form.append("phone", data.phone);
  form.append("address", data.address);
  return await axios.post('/api/v1/user/update-account', form);
}

export {
  login,
  logout,
  forgotPassword,
  resetPassword,
  changePassword,
  updateAccount
};
