export default {
  getServiceList: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/admin/services?page=${paged}`)

      commit('SET_SERVICES', resp)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },

  getServiceId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/services/${id}`)
      commit('SERVICE_DETAIL', resp)
      //response

      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },

  createService: async function ({ commit }, data) {
   
      const resp = await this.$axios.post(`/api/admin/services`, data)

      // response
      commit('CREATE_SERVICE', data)
      return resp
      
  },

  updateService: async function ({ commit }, data) {
    
      const resp = await this.$axios.put(`/api/admin/services/${data.id}`, data)
      commit('UPDATE_SERVICE', data)
      return resp
   
  },

  removeService: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/services/${id}`)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
    commit("DELETE_SERVICE", id)
  },
}
