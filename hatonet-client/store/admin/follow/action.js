export default {
    getAll: async function ({ commit } , params) {
        let {
          idUser = idUser ? idUser : '',
          idCompany = idCompany ? idCompany : ''
        } = params;
        if(idCompany){
          const resp = await this.$axios.get(`/api/admin/follow?idUser=${idUser.id}&idCompany=${idCompany}`);
          commit("SET_FOLLOW", resp.data);
          return resp;
        }else{
          const resp = await this.$axios.get(`/api/admin/follow?idUser=${idUser.id}&idProduct=${idProduct}`);
          commit("SET_FOLLOW", resp.data);
          return resp;
        }
    },
    getById: async function ({ commit }, id) {
      const resp = await this.$axios.get(`/api/admin/follow/${id}`)
      commit("SET_FOLLOW_SHOW", resp.data);
      return resp;
    },
    create: async function ({ commit }, params) {
      let {
        idUser = idUser ? idUser : '',
        idCompany = idCompany ? idCompany : '',
        data = data ? data : {}
      } = params;
      if(idCompany){
        const resp = await this.$axios.post(`/api/admin/follow?idCompany=${idCompany}`, data)
        commit("CREATE_FOLLOW", resp.data);
        return resp;
      }else{
        const resp = await this.$axios.post(`/api/admin/follow?idProduct=${idProduct}`, data)
        commit("CREATE_FOLLOW", resp.data);
        return resp;
      }
    },
    update: async function ({ commit }, data) {
      const resp = await this.$axios.put(`/api/admin/follow/${data.id}`, data)
     // commit("UPDATE_FOLLOW", resp.data);
      return resp;
    },
    remove: async function ({ commit }, id) {
      const resp = await this.$axios.delete(`/api/admin/follow/${id}`);
     // commit("DELETE_FOLLOW", resp.data);
      return resp;
    },
  }