export default {
  getAll: async function ({ commit }) {
    try {
      const resp = await this.$axios.get(`api/admin/custom_review`)
      commit('GET_ALL', resp.data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  getId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`api/admin/custom_review/${id}`)
      commit('GET_ID', resp.data)
      //response
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  remove: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`api/admin/custom_review/${id}`)
      commit('REMOVE', resp.data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
}
