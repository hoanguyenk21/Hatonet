const config = {
  headers: {
    'Content-Type': 'multipart/form-data'
  }
}
export default {
  getAll: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.get(`/api/admin/apply`);
      commit("SET_APPLY", resp.data);
      return resp
    } catch (error) {
      this.$mixError(error);
    }
  },

  getapply: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/apply/${id}`);
      commit("SET_APPLY_SHOW", resp.data);
      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }

  },

  createApply: async function ({
    commit
  }, data) {
    console.log(data);
    const resp = await this.$axios.post(`/api/admin/apply`, data)
    //commit("CREATE_POST", data)
    return resp;
  },

  updateapply: async function ({ commit }, params) {
    let {
      id = id ? id : '',
      data = data ? data : ''
    } = params;
    try {
      const resp = await this.$axios.post(`/api/admin/apply/${id}`, data);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("UPDATE_APPLY", data)
  },

  removeapply: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/apply/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit("DELETE_ACC", id)
  },
};

