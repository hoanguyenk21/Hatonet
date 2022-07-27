export default {
  getSettingList: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/settings?page=${paged}`);
    } catch (error) {
      this.$mixError(error);
    }
  },
  getSettingId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/settings/${id}`);

      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  createSetting: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.delete(`/api/settings`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  updateSetting: async function ({ commit }, id, data) {
    try {
      const resp = await this.$axios.delete(`/api/settings/${id}`, data);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  removeSetting: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/settings/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
};
