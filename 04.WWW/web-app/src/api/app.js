import axios from "../plugins/https";

async function getListCustomer() {
  return await axios.get('/api/v1/customer/list');
}

async function getListFactory(data) {
  let form = new FormData();
  form.append("customer_id", data);
  return await axios.post('/api/v1/factory/list',form);
}
async function getDetailFactory(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await axios.post('/api/v1/factory/detail',form);
}
async function getListSensor(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await axios.post('/api/v1/sensor/list', form);
}
async function getListMotor(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await axios.post('/api/v1/motor/list', form);
}

async function getListValve(data) {
  let form = new FormData();
  form.append("factory_id", data);
  return await axios.post('/api/v1/valve/list', form);
}

async function updateSetPoint(data) {
  let form = new FormData();
  form.append("id_set_point", data.idSetPoint);
  form.append("field_set_point", data.fieldSetPoint);
  form.append("value_set_point", data.value);
  return await axios.post('/api/v1/sensor/update-set-point', form);
}

export {
  getListCustomer,
  getListFactory,
  getDetailFactory,
  getListSensor,
  getListMotor,
  getListValve,
  updateSetPoint
};
