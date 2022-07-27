export default {
    getProductList: async function ({ commit }, params) {
      try {
        const resp = await this.$axios.get(`/api/jobs?keyword=${params.keyword}&province=${params.province}&skill=${params.skill}`)
        commit('SET_PRODUCTS', resp.data)
      } catch (error) {
        this.$mixError(error)
      }
    },

    getProductId: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.get(`/api/jobs/${id}`);
        commit('SET_PRODUCT_SHOW', resp.data)
        //response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
    },

    createProduct: async function ({ commit }, data) {
      try {
        const resp = await this.$axios.delete(`/api/jobs`, data);

        // response
        return resp;
      } catch (error) {
        this.$mixError(error);
      }
    },

    updateProduct: async function ({ commit }, id, data) {
      try {
        const resp = await this.$axios.delete(`/api/jobs/${id}`, data);

        return resp;
      } catch (error) {
        this.$mixError(error);
      }
    },

    removeProduct: async function ({ commit }, id) {
      try {
        const resp = await this.$axios.delete(`/api/jobs/${id}`);

        return resp;
      } catch (error) {
        this.$mixError(error);
      }
    },

    async downloadFile(){
      try {
        const resp = await this.$axios.get('/api/jobs/download',{responseType: 'blob',})
        .then((res) => {
          const FILE = window.URL.createObjectURL(new Blob([res.data],{ type: 'application/pdf' }));
          let docUrl = document.createElement('a');
                     docUrl.href = FILE;
                     docUrl.setAttribute('download', 'file.pdf');
                     document.body.appendChild(docUrl);
                     docUrl.click();
        })
        .catch((e) => e)
        return resp
      } catch (error) {
        this.$mixError(error);
      }
    }
  };
