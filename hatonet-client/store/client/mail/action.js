export default {
  getAll: async function ({ commit }) {
    try {
      const resp = await this.$axios.get(`api/mail`)
      commit('GET_ALL', resp.data)
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  // getAlls: async function ({ commit }) {
  //   try {
  //     const resp = await this.$axios.get(`api/mail/recived`)
  //     commit('SET_RECIVED', resp.data)
  //     return resp
  //   } catch (error) {
  //     this.$mixError(error)
  //   }
  // },
  getPageId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/posts/${id}`)

      //response
      return resp
    } catch (error) {
      this.$mixError(error)
    }
  },
  // MailSend: async function ({ commit }, data) {
  //   try {
  //     const resp = await this.$axios.delete(`api/mail/send`, data)
  //     return resp
  //   } catch (error) {
  //     this.$mixError(error) 
  //   }
  // },
  MailSend: async function ({ commit }, data) {
    const resp = await this.$axios.post(`api/mail/send`, data)
    commit('SEND_MAIL', data)
    return resp

  },
  MailRecived: async function ({ commit }, data) {
  return await this.$axios.post(`api/mail/recived`, data)
    commit('SEND_RECIVED', data)

  },
  // updatePage: async function ({ commit }, id, data) {
  //   try {
  //     const resp = await this.$axios.delete(`/api/posts/${id}`, data)

  //     return resp
  //   } catch (error) {
  //     this.$mixError(error)
  //   }
  // },
  // removePage: async function ({ commit }, id) {
  //   try {
  //     const resp = await this.$axios.delete(`/api/posts/${id}`)

  //     return resp
  //   } catch (error) {
  //     this.$mixError(error)
  //   }
  // },
}
