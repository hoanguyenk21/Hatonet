export default {
  SET_PAGES: function (state, payload) {
    state.pages = payload;
  },

  SET_PAGE_SHOW: function (state, payload) {
      state.show = payload;
  },

  CREATE_PAGE(state, data){
    state.pages.data.push(data)
  },
  DELETE_PAGE(state, id) {
    state.pages = state.pages.data.filter((post) => {
          return post.id !== id;
    });
  },

  UPDATE_PAGE(state, data){
    const index = state.pages.findIndex((post) => {
      return post.id === data.id
    })
    state.pages.splice(index, 1, data)
  }



};
