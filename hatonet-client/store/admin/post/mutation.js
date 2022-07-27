export default {
  SET_POSTS: function (state, payload) {
    state.items = payload;
  },

  SET_POST_SHOW: function (state, payload) {
      state.show = payload;
  },

  CREATE_POST(state, data){
    state.items.push(data)
  },
  DELETE_POST(state, id) {
    state.items = state.items.data.filter((post) => {
          return post.id !== id;
    });
  },

  UPDATE_POST(state, data){
    const index = state.items.findIndex((post) => {
      return post.id === data.id
    })
    state.items.splice(index, 1, data)
  }



};
