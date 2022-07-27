export default {
    getPackageList: async function ({ commit }, payload) {
      try {
        const resp = await this.$axios.get(`/api/package?userId=${payload.userId}&status=${payload.status}&page=${payload.page}`);
        commit('SET_PACKAGES',resp)
        return resp
      } catch (error) {
        this.$mixError(error);
      }
    },
    getPackageId: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/package/${id}`);
        commit('SET_PACKAGE_SHOW',resp)
        //response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
    },

    getExpire: async function ({ commit }, data) {
    
        const resp = await this.$axios.post(`/api/package`, data);

        // response
        return resp.data;
      
    },

    update: async function ({ commit },data) {
      try {
        const resp = await this.$axios.put(`/api/package/${data.id}`,data.body );
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit('UPDATE_PACKAGE', data)
    },

    remove: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/package/${id}`);

        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("DELETE_PACKAGE", id)
    },

    stopPackage: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.put(`/api/package/${data.id}`, data);

        // response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("STOP_PACKAGE", data)
    },
  };
