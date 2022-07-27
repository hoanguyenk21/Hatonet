export default {
  GET_ALL: function (state, payload) {
    state.customerReview = payload;
  },
  GET_ID: function (state, payload) {
      state.show = payload;
  },
  REMOVE(state, id) {
    state.customerReview = state.customerReview.filter((item) => {
          return item.id !== id;
    });
  },
};
