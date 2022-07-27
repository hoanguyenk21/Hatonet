export default {
    SET_PRODUCTS: function (state, payload) {
        state.items = payload;
        // paginate
        state.paginate = payload.data.paginate;
      },
    SET_PRODUCT_SHOW: function (state, payload) {
      state.show = payload;
    },
  };
  