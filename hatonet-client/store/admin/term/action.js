export default {
  getAll: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/admin/terms?type=post&page=${paged}`)

      commit('GET_TERM', resp)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },

  getById: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/terms/${id}`)
      commit('TERM_DETAIL', resp)

     return resp
    } catch (error) {
      this.$mixError(error)
    }
  },

  create: async function ({ commit }, data) {
    const resp = await this.$axios.post(`/api/admin/terms`, data)
    commit('CREATE_TERM', data)
    return resp
},

  update: async function ({ commit }, data) {
    
    const resp = await this.$axios.put(`/api/admin/terms/${data.id}`, data)
    commit('UPDATE_TERM', data)
    return resp
 
},

  remove: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/terms/${id}`);
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
}
