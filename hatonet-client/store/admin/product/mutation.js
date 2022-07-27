export default {
  SET_PRODUCT_DETAIL:function(state, payload) {
    state.detail = payload.data;
  },
  SET_PRODUCTS: function (state, payload) {
    state.productes = payload;
    // paginate
    state.paginate = payload.data.paginate;
  },
  SET_PRODUCT_SHOW: function (state, payload) {
    state.show = payload.data;
  },
  UPLOAD_PRODUCT_SHOW: function (state, payload) {
    state.upload = payload.data;
  },
  CREATE_PRODUCT(state, data){
    state.items.push(data)
  },
  UPDATE_PRODUCT(state, data){
    const index = state.items.findIndex((product) => {
      return product.id === data.id
    })
    state.items.splice(index, 1, data)
  },
};
