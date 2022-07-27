export default {
  getTicketList: async function ({ commit }, paged = 1) {
    try {
      const resp = await this.$axios.get(`/api/tickets?page=${paged}`);
    } catch (error) {
      this.$mixError(error);
    }
  },
  getTicketId: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.get(`/api/tickets/${id}`);

      //response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  createTicket: async function ({ commit }, data) {
    try {
      const resp = await this.$axios.delete(`/api/tickets`, data);

      // response
      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  updateTicket: async function ({ commit }, id, data) {
    try {
      const resp = await this.$axios.delete(`/api/tickets/${id}`, data);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
  removeTicket: async function ({ commit }, id) {
    try {
      const resp = await this.$axios.delete(`/api/tickets/${id}`);

      return resp;
    } catch (error) {
      this.$mixError(error);
    }
  },
};
