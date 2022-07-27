export default {
  SET_SETTINGS: function (state, payload) {
    state.items = payload.data.items;
    // paginate
    state.paginate = payload.data.paginate;
  },
  SET_SETTING_SHOW: function (state, payload) {
    state.show = payload.data.item;
  },
};
