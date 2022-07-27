export default {
    SET_USER: function (state, payload) {
      state.users = payload;
    },
  
    SET_USER_SHOW: function (state, payload) {
        state.user = payload;
    },
  
    CREATE_USER(state, data){
      state.users.push(data)
    },

    DELETE_USER(state, id) {
      state.users = state.users.data.filter((user) => {
            return user.id !== id;
      });
    },
  
    UPDATE_USER(state, data){
      const index = state.users.findIndex((user) => {
        return user.id === data.id
      })
      state.users.splice(index, 1, data)
    }
  };
  