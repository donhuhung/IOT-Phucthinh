async function getListFactory() {
  return await this.$axios.$get('/api/v1/factory/list');
}
async function getListSensor(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await this.$axios.$post('/api/v1/sensor/list', form);
}
async function getListMotor(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await this.$axios.$post('/api/v1/motor/list', form);
}

async function getListValve(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await this.$axios.$post('/api/v1/valve/list', form);
}

export {
  getListFactory,
  getListSensor,
  getListMotor,
  getListValve
};
