export default {
    getServiceList: async function ({ commit }, paged = 1) {
      try {
        const resp = await this.$axios.get(`/api/service?page=${paged}`)
  
        commit('SET_SERVICES', resp)
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
  
    getServiceId: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/service/${id}`)
        commit('SERVICE_DETAIL', resp)
        //response
  
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
  
    createService: async function ({ commit }, data) {
     
        const resp = await this.$axios.post(`/api/service`, data)
  
        // response
        commit('CREATE_SERVICE', data)
        return resp
        
    },
  
    updateService: async function ({ commit }, data) {
      
        const resp = await this.$axios.put(`/api/service/${data.id}`, data)
        commit('UPDATE_SERVICE', data)
        return resp
     
    },
  
    removeService: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/service/${id}`)
  
        return resp
      } catch (error) {
        this.$mixError(error)
      }
      commit("DELETE_SERVICE", id)
    },
  }
  