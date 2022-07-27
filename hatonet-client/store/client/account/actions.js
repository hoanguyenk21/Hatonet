const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }

  export default {
    getAll: async function ({ commit }, payload) {
      try {
        const resp = await this.$axios.get(`/api/account?id=${payload.id}&search=${payload.text}&status=${payload.status}&page=${payload.page}`);
        commit("SET_ACCOUNTS", resp.data);

        return resp
      } catch (error) {
        this.$mixError(error);
      }
    },

    getAccountId: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/account/${id}`);
        commit("SET_ACCOUNT_SHOW", resp);
        //response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }

    },

    createAccount: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.post(`/api/account`, data, config);
        // response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("CREATE_ACC",data)
    },

    updateAccount: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.put(`/api/account/${data.id}`, data);
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("EDIT_ACC", data)
    },

    removeAccount: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/account/${id}`);
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("DELETE_ACC",id)
    },
  };

