export default {
    SET_FOLLOW: function (state, payload) {
      state.follows = payload;
    },
  
    SET_FOLLOW_SHOW: function (state, payload) {
        state.follow = payload;
    },
    CREATE_FOLLOW(state, data){
      state.follows.follows.push(data)
    },
    UPDATE_FOLLOW(state, data){
      const index = state.follows.follows.findIndex((review) => {
        return review.id === data.id
      })
      state.follows.splice(index, 1, data)
    },
    DELETE_FOLLOW(state, id) {
      state.follows.follows = state.follows.follows.filter((review) => {
            return review.id !== id;
      });
    },
  };
  