export default {
    GET_TERM: function (state, payload) {
      state.items = payload.data;
    },

    CREATE_TERM(state, data){
      state.items.push(data)
    },

    UPDATE_TERM(state, data){
      const index = state.items.findIndex((term) => {
        return term.id === data.id
      })
      state.items.splice(index, 1, data)
    },

    TERM_DETAIL(state, data){
      state.item = data.data
    },

    DELETE_SERVICE(state, id){
      state = state.splice(id,1)
    }
  };
