const config = {
  headers: {
    'Content-Type': 'multipart/form-data'
  }
}

export default {
  getAll: async function ({ commit }, payload) {
    try {
      const resp = await this.$axios.get(`/api/admin/accounts?search=${payload.text}&status=${payload.status}&page=${payload.page}`);
      commit("SET_ACCOUNTS", resp.data);
      return resp
    } catch (error) {
      this.$mixError(error);
    }
  },
  getUsers: async function ({ commit }, payload) {
    try {
      const resp = await this.$axios.get(`/api/admin/accounts/users?id=${payload.id}&search=${payload.text}&status=${payload.status}&page=${payload.page}`);
      commit("SET_USERS", resp.data);
      return resp
    } catch (error) {
      this.$mixError(error);
    }
  },
  getAccount: async function ({ commit }, ) {
    try {
      const resp = await this.$axios.get(`/api/admin/accounts`);
      commit("SET_ACCOUNT", resp.data);
      return resp
    } catch (error) {
      this.$mixError(error);
    }
  },
  getAccountId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/accounts/${id}`);
      commit("SET_ACCOUNT_SHOW", resp);
      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  createAccount: async function ({ commit }, data) {
    const resp = await this.$axios.post(`/api/admin/accounts`, data)
    commit('CREATE_ACC', data)
    return resp
},
  updateAccount: async function ({ commit }, data) {
    //try {
      return await this.$axios.put(`/api/admin/accounts/${data.id}`, data);
      //commit("EDIT_ACC", data)

    // } catch (error) {
    //   this.$mixError(error);
    // }

  },

  removeAccount: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/accounts/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("DELETE_ACC",id)
  },

  async changPassword({commit},data){
    const resp = await this.$axios.post('/api/admin/accounts/password',data)
    console.log(resp)
    return resp
  }
};

