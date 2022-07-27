export default {
  SET_APPLY: function (state, payload) {
    state.applies = payload;
  },

  SET_APPLY_SHOW: function (state, payload) {
      state.apply = payload;
  },

  CREATE_APPLY(state, data){
    state.applies.push(data)
  },

  DELETE_APPLY(state, id) {
    state.applies = state.applies.data.filter((apply) => {
          return apply.id !== id;
    });
  },

  UPDATE_APPLY(state, data){
    const index = state.applies.findIndex((apply) => {
      return apply.id === data.id
    })
    state.applies.splice(index, 1, data)
  }
};
