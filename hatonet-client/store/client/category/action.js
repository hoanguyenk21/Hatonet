export default {
    getAll: async function ({ commit }, paged = 1) {
        const resp = await this.$axios.get(
          `/api/taxonomies?type=post&page=${paged}`
        )
        
        return resp;
    },
    getById: async function ({ commit }, id) {
      return await this.$axios.get(`/api/taxonomies/${id}`)
    },
    create: async function ({ commit }, data) {
      return await this.$axios.post(`/api/taxonomies`, data)
    },
    update: async function ({ commit }, id, data) {
      return await this.$axios.put(`/api/taxonomies/${id}`, data)
    },
    remove: async function ({ commit }, id) {
      return await this.$axios.delete(`/api/taxonomies/${id}`)
    },
  }