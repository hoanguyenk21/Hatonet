export default {
    SET_POSTS: function (state, payload) {
      state.items = payload.items;
      // paginate
      state.paginate = payload.paginate;
    },
  
    SET_POST_SHOW: function (state, payload) {
      state.show = payload.data.item;
    },
  
    DELETE_POST(state, id) {
      state.items = state.items.filter((post) => {
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