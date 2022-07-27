export default {
  getProductList: async function ({ commit }, params) {
    try {
      let paged =  params.page ?  params.page : 1;
      let {
        SearchNumber = SearchNumber ? SearchNumber : '',
        SearchStatus = SearchStatus ? SearchStatus : '',
        SearchTerm = SearchTerm ? SearchTerm : ''
      } = params;
      if (SearchNumber) {
        const resp = await this.$axios.get(`/api/admin/products?SearchNumber=${SearchNumber}&page=${paged}`)
        commit("SET_PRODUCTS", resp.data)
        return resp;
      } else if (SearchStatus) {
        const resp = await this.$axios.get(`/api/admin/products?SearchStatus=${SearchStatus}&page=${paged}`)
        commit("SET_PRODUCTS", resp.data)
        return resp;
      } else if (SearchTerm) {
        const resp = await this.$axios.get(`/api/admin/products?SearchTerm=${SearchTerm}&page=${paged}`)
        commit("SET_PRODUCTS", resp.data)
        return resp;
      } else {
        const resp = await this.$axios.get(`/api/admin/products?page=${paged}`)
        commit("SET_PRODUCTS", resp.data)
        return resp;
      }
    } catch (error) {
      this.$mixError(error)
    }
  },

  getProductId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/admin/products/${id}`);
      commit("SET_PRODUCT_DETAIL", resp)
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },

  createProduct: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.post(`/api/admin/products`, data);
      commit("CREATE_PRODUCT", resp.data)
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },

  updateProduct: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.put(`/api/admin/products/${data.id}`, data);
      commit("UPDATE_PRODUCT", resp.data)
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },

  removeProduct: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/admin/products/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
};
