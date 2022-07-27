const config = {
  headers: {
    'Content-Type': 'multipart/form-data'
  }
}
export default {
  getAll: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.get(`/api/admin/user`);
      commit("SET_USER", resp.data);
      return resp
    } catch (error) {
      this.$mixError(error);
    }
  },
  
  getUser: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/user/${id}`);
      commit("SET_USER_SHOW", resp.data);
      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }

  },

  createUser: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/user`, data, config);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("CREATE_ACC",data)
  },
  
  updateUser: async function ({ commit }, params) {
    let {
      id = id ? id : '',
      data = data ? data : ''
    } = params;
    try {
      const resp = await this.$axios.post(`/api/admin/user/${id}`, data);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
   commit("UPDATE_USER", data)
  },

  removeUser: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/user/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("DELETE_ACC",id)
  },
};

