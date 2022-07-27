const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }
  export default {
    getAll: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.get(`/api/users`);
        commit("SET_USER", resp.data);
        return resp
      } catch (error) {
        this.$mixError(error);
      }
    },
    
    getUser: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/users/${id}`);
        commit("SET_USER_SHOW", resp.data);
        //response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
  
    },
  
    createUser: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.post(`/api/users`, data, config);
  
        // response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("CREATE_ACC",data)
    },
    
    updateUser: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.put(`/api/users/${data.id}`, data);
  
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("EDIT_ACC", data)
    },
  
    removeUser: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/users/${id}`);
  
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
      commit("DELETE_ACC",id)
    },
  };
  
  