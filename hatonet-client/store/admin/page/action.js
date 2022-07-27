export default {
  getPageList: async function ({
    commit
  }, params) {
    try {
      let paged = params.page ? params.page : 1;
      let {
        keyword = keyword ? keyword : '',
        number = number ? number : ''
      } = params;
      if(keyword){
        const resp = await this.$axios.get(`/api/admin/posts?type=page&search=${keyword}&page=${paged}`)
        commit("SET_PAGES", resp.data)
        return resp;
      }else if(number){
        const resp = await this.$axios.get(`/api/admin/posts?type=page&number=${number}&page=${paged}`)
        commit("SET_PAGES", resp.data)
        return resp;
      }else{
        const resp = await this.$axios.get(`/api/admin/posts?type=page&page=${paged}`)
        commit("SET_PAGES", resp.data)
        return resp;
      }   
    } catch (error) {
      this.$mixError(error)
    }
  },

  getPageId: async function ({
    commit
  }, params) {
    try {
      let {
        id
      } = params
      const resp = await this.$axios.get(`/api/admin/posts/${id}`)
      commit("SET_PAGE_SHOW", resp.data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  createPage: async function ({
    commit
  }, data) {
    const resp = await this.$axios.post(`/api/admin/posts`, data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    //commit("CREATE_PAGE", resp.data)
    return resp;
  },
  createPageTag: async function ({
    commit
  }, data) {
    const resp = await this.$axios.post(`/api/admin/terms`, data)
    return resp;
  },
  async updatePage({
    commit
  }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/posts/${data.get("id")}`, data, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'method': 'POST'
        }
      })
      commit('UPDATE_PAGE', data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }

  },
  async removePage({
    commit
  }, listProductSelected) {
    try {
      await this.$axios.$delete(`/api/admin/posts/${listProductSelected}`)    
      return resp
    } catch (error) {
      this.$mixError(error)
    }
    commit('DELETE_PAGE', listProductSelected)
  },
}
