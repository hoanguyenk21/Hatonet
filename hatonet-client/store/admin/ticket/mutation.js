export default {
  SET_TICKETS: function (state, payload) {
    state.items = payload.data.items;
    // paginate
    state.paginate = payload.data.paginate;
  },
  SET_TICKET_SHOW: function (state, payload) {
    state.show = payload.data.item;
  },
};
