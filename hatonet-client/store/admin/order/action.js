export default {
  getOrderList: async function ({ commit }, payload) {
    const records = payload.recordNumber ? payload.recordNumber : null
    try {
      if(Object.entries(payload).length == 0){
        const resp = await this.$axios.get(`/api/admin/orders`);
        commit('SET_ORDERS',resp)
        return resp
      }
      if(records != null){
        const resp = await this.$axios.get(`/api/admin/orders?records=${records}`);
        commit('SET_ORDERS',resp)
        return resp
      } else {
        const resp = await this.$axios.get(`/api/admin/orders?status=${payload.status}&search=${payload.text}&page=${payload.page}`);
        commit('SET_ORDERS',resp)
        return resp
      }
      
    } catch (error) {
      this.$mixError(error);
    }
  },

  getOrderId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/orders/${id}`);
      commit('SET_ORDER_SHOW',resp)
      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },

  create: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/orders`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("CREATE_ORDER", data)
  },

  updateOrder: async function ({ commit },data) {
    try {
      const resp = await this.$axios.put(`/api/admin/orders/${data.id}`, data.body);
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit('UPDATE_ORDER', data)
  },

  removeOrder: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/orders/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("DELETE_ORDER", id)
  },

  stopService: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.put(`/api/admin/orders/${data.id}`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("STOP_SERVICE", data)
  },
};

