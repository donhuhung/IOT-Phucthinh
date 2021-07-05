async function getListFactory() {
  return await this.$axios.$get('/api/v1/factory/list');
}

export {
  getListFactory,
};
