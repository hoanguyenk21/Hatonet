export default {
  getPackageList: async function ({ commit }, payload) {
    const records = payload.recordNumber ? payload.recordNumber : null
    try {
      if(Object.entries(payload).length == 0){
        const resp = await this.$axios.get(`/api/admin/packages`);
        commit('SET_PACKAGES',resp)
        return resp
      }
      if(records != null){
        const resp = await this.$axios.get(`/api/admin/packages?records=${records}`);
        commit('SET_PACKAGES',resp)
        return resp
      } else {
        const resp = await this.$axios.get(`/api/admin/packages?status=${payload.status}&search=${payload.text}&page=${payload.page}`);
        commit('SET_PACKAGES',resp)
        return resp
      }
      
    } catch (error) {
      this.$mixError(error);
    }
  },
  getVnpayPayment: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.post(`api/admin/package/vnpay-payment` , data);
     // commit('SET_VNPAY',resp)
      return resp
    } catch (error) {
      this.$mixError(error);
    }
    commit("VNPAY_PAYMENT", data)
  },
  getPackageId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/packages/${id}`);
      commit('SET_PACKAGE_SHOW',resp)
      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },

  create: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/packages`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("CREATE_PACKAGE", data)
  },

  update: async function ({ commit },data) {
    try {
      const resp = await this.$axios.put(`/api/admin/packages/${data.id}`, data.body);
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit('UPDATE_PACKAGE', data)
  },

  remove: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/packages/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("DELETE_PACKAGE", id)
  },

  stopPackage: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.put(`/api/admin/packages/${data.id}`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("STOP_PACKAGE", data)
  },
};

