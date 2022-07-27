export default {
  getNotifyList: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/admin/notifies?page=${paged}`);
      commit('SET_NOTIFIES', resp)
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  getNotifyAccount: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/admin/accounts-list`);
      commit('SET_ACCOUNTS', resp.data)
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  // getNotifyId: async function ({ commit }, id) {
  //   try {
  //     const resp = await this.$axios.get(`/api/admin/notifies/${id}`);
  //     return resp;
  //   } catch (error) {
  //     this.$mixError(error);
  //   }
  //   commit('DELETE_POST', id)
  // },
  getNotifyId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/notifies/${id}`)
      commit('NOTIFIES_DETAIL', resp)
      //response

      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  // createNotify: async function ({ commit }, data) {
  //   const resp = await this.$axios.post(`/api/admin/notifies`, data)
  //   console.log(data);
  //   return resp;
  // },
  createNotify: async function ({ commit }, data) {
   
    const resp = await this.$axios.post(`/api/admin/notifies`, data)

    // response
    commit('CREATE_NOTIFIES', data)
    return resp
    
},
  updateNotifyActison: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.put(`/api/admin/notifies/status/${data.id}`, data);
      console.log(resp)
    } catch (error) {
      this.$mixError(error);
    }
  },
  // async updateNotify({
  //   commit
  // }, data) {
  //   const resp = await this.$axios.put(`/api/admin/notifies/${data.id}`, data)
  //   commit('UPDATE_NOTIFIES', data)
  //   return resp
  // },
  updateNotify: async function ({ commit }, data) {
    
    const resp = await this.$axios.put(`/api/admin/notifies/${data.id}`, data)
    commit('UPDATE_NOTIFIES', data)
    return resp
 
},

  removeNotify: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/notifies/${id}`);
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
    commit('DELETE_POST', id)
  },
};

