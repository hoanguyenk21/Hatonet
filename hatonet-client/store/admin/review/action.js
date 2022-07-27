export default {
    getAll: async function ({ commit } , params) {
        let {
          idCompany = idCompany ? idCompany : '',
          idProduct = idProduct ? idProduct : '' 
        } = params;
        if(idCompany){
          const resp = await this.$axios.get(`/api/admin/reviews?idCompany=${idCompany}`);
          commit("SET_REVIEW", resp.data);
          return resp;
        }else{
          const resp = await this.$axios.get(`/api/admin/reviews?idProduct=${idProduct}`);
          commit("SET_REVIEW", resp.data);
          return resp;
        }
    },
    getById: async function ({ commit }, id) {
      const resp = await this.$axios.get(`/api/admin/reviews/${id}`)
      commit("SET_REVIEW_SHOW", resp.data);
      return resp;
    },
    create: async function ({ commit }, params) {
      let {
        idUser = idUser ? idUser : '',
        idCompany = idCompany ? idCompany : '',
        idProduct = idProduct ? idProduct : '',
        data = data ? data : {}
      } = params;
      if(idCompany){
        const resp = await this.$axios.post(`/api/admin/reviews?idCompany=${idCompany}`, data)
        commit("CREATE_REVIEW", resp.data);
        return resp;
      }else{
        const resp = await this.$axios.post(`/api/admin/reviews?idProduct=${idProduct}`, data)
        commit("CREATE_REVIEW", resp.data);
        return resp;
      }
    },
    update: async function ({ commit }, data) {
      const resp = await this.$axios.put(`/api/admin/reviews/${data.id}`, data)
     // commit("UPDATE_REVIEW", resp.data);
      return resp;
    },
    remove: async function ({ commit }, id) {
      const resp = await this.$axios.delete(`/api/admin/reviews/${id}`);
     // commit("DELETE_REVIEW", resp.data);
      return resp;
    },
  }