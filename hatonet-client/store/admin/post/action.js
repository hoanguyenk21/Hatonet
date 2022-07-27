export default {
  getPostList: async function ({
    commit
  }, params) {
    try {
      let paged = params.page ? params.page : 1;
      let {
        keyword = keyword ? keyword : '',
        number = number ? number : ''
      } = params;
      if (keyword) {
        const resp = await this.$axios.get(`/api/admin/posts?type=post&search=${keyword}&page=${paged}`)
        commit("SET_POSTS", resp.data)
        return resp;
      } else if (number) {
        const resp = await this.$axios.get(`/api/admin/posts?type=post&number=${number}&page=${paged}`)
        commit("SET_POSTS", resp.data)
        return resp;
      } else {
        const resp = await this.$axios.get(`/api/admin/posts?type=post&page=${paged}`)
        commit("SET_POSTS", resp.data)
        return resp;
      }
    } catch (error) {
      this.$mixError(error)
    }
  },

  getPostId: async function ({
    commit
  }, params) {
    try {
      let {
        id
      } = params
      const resp = await this.$axios.get(`/api/admin/posts/${id}`)
      commit("SET_POST_SHOW", resp.data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  createPost: async function ({
    commit
  }, data) {
    console.log(data);
    const resp = await this.$axios.post(`/api/admin/posts`, data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    //commit("CREATE_POST", data)
    return resp;
  },
  createPostTag: async function ({
    commit
  }, data) {
    const resp = await this.$axios.post(`/api/admin/terms`, data)
    return resp;
  },
  async updatePost({
    commit
  }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/posts/${data.get("id")}`, data, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'method': 'POST'
        }
      })
      commit('UPDATE_POST', data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }

  },
  async removePost({
    commit
  }, listProductSelected) {
    try {
      await this.$axios.$delete(`/api/admin/posts/${listProductSelected}`)

      return resp
    } catch (error) {
      this.$mixError(error)
    }
    commit('DELETE_POST', listProductSelected)
  },
}
