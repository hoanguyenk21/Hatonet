export default {
  getPostList: async function ({ commit },) {
    try {
      const resp = await this.$axios.get(`/api/posts?page=${paged}`)
      commit("SET_POSTS", resp.data)
      return resp;
    } catch (error) {
      this.$mixError(error)
    }
  },

  getPostId: async function ({
    commit
  }, id) {
    try {
      const resp = await this.$axios.get(`/api/posts/${id}`)
      //response
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  createPost: async function ({ commit }, data) {
    const resp = await this.$axios.post(`/api/posts`, data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    return resp;
  },
  createPostTag: async function ({
    commit
  }, data) {
    const resp = await this.$axios.post(`/api/terms`, data)
    return resp;
  },
  async updatePost({
    commit
  }, data) {
    try {
    const resp = await this.$axios.post(`/api/posts/${data.get("id")}`, data, {
    })
    commit('UPDATE_POST', data)
    return resp
    } catch (error) {
      this.$mixError(error)
    }

  },

  removePost: async function ({
    commit
  }, id) {
    try {
      const resp = await this.$axios.$delete(`/api/posts/${id}`)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
    commit('DELETE_POST', id)
  },


}
