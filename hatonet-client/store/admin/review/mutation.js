export default {
    SET_REVIEW: function (state, payload) {
      state.reviews = payload;
    },
  
    SET_REVIEW_SHOW: function (state, payload) {
        state.review = payload;
    },
    CREATE_REVIEW(state, data){
      state.reviews.reviews.push(data)
    },
    UPDATE_REVIEW(state, data){
      const index = state.reviews.reviews.findIndex((review) => {
        return review.id === data.id
      })
      state.reviews.splice(index, 1, data)
    },
    DELETE_REVIEW(state, id) {
      state.reviews.reviews = state.reviews.reviews.filter((review) => {
            return review.id !== id;
      });
    },
  
  
  
  
  };
  