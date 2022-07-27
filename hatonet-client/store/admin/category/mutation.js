export default {
  SET_CATEGORIES: function (state, payload) {
    state.categories = payload;
    // paginate
    state.paginate = payload.paginate;
  },
  SET_CATEGORY_SHOW: function (state, payload) {
    state.category = payload;
  },
  CREATE_CATEGORY(state, data){
    state.categories.push(data)
  },
  DELETE_CATEGORY(state, id) {
    state.categories = state.categories.filter((post) => {
          return post.id !== id;
    });
  },
  UPDATE_CATEGORY(state, data){
    const index = state.categories.findIndex((post) => {
      return post.id === data.id
    })
    state.categories.splice(index, 1, data)
  }
};
