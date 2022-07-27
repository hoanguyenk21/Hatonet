export default {
    getAll: async function ({ commit }, paged = 1) {
        const resp = await this.$axios.get(
          `/api/term?type=post&page=${paged}`
        )
        commit("SET_CATEGORY",resp.data);
        return resp;
    },
    getById: async function ({ commit }, id) {
      return await this.$axios.get(`/api/term/${id}`)
    },
    create: async function ({ commit }, data) {
      return await this.$axios.post(`/api/term`, data)
    },
    update: async function ({ commit }, id, data) {
      return await this.$axios.put(`/api/term/${id}`, data)
    },
    remove: async function ({ commit }, id) {
      return await this.$axios.delete(`/api/term/${id}`)
    },
  }