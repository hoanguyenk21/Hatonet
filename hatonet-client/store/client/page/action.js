export default {
    getAll: async function ({ commit }, paged = 1) {
      try {
        const resp = await this.$axios.get(`/api/post?type=page&page=${paged}`)
        commit('SET_PAGES', resp.data)
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
    getPageId: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/posts/${id}`)
  
        //response
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
    createPage: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.delete(`/api/posts`, data)
  
        // response
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
    updatePage: async function ({ commit }, id, data) {
      try {
        const resp = await this.$axios.delete(`/api/posts/${id}`, data)
  
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
    removePage: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/posts/${id}`)
  
        return resp
      } catch (error) {
        this.$mixError(error)
      }
    },
  }
  