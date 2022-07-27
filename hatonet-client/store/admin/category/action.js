export default {
  getAll: async function ({ commit }) {
    let paged = 1;
      const resp = await this.$axios.get(
        `/api/admin/taxonomies?page=${paged}`
      )
      commit("SET_CATEGORIES" , resp.data);
      return resp;
  },
  getById: async function ({ commit }, id) {
    const resp = await this.$axios.get(`/api/admin/taxonomies/${id}`)
    commit("SET_CATEGORY_SHOW" , resp.data);
    return resp;
  },
  create: async function ({ commit }, data) {
    const resp = await this.$axios.post(`/api/admin/taxonomies`, data)
    commit("CREATE_CATEGORY" , resp.data);
    return resp;
  },
  update: async function ({ commit } , data) {
    const resp = await this.$axios.put(`/api/admin/taxonomies/${data.id}`, data)
    commit("UPDATE_CATEGORY" , resp.data);
    return resp;
  },
  remove: async function ({ commit }, id) {
    const resp = await this.$axios.delete(`/api/admin/taxonomies/${id}`)
    commit("DELETE_CATEGORY" , resp.data);
    return resp;
  },
}
