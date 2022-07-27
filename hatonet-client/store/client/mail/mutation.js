export default {
    GET_ALL: function (state, payload) {
      state.send = payload;
    },
    SET_RECIVED: function (state, payload) {
        state.recived = payload;
      },
    SET_ACCOUNTS: function (state, payload) {
      state.accounts = payload;
    },
    SEND_MAIL(state, data){
      state.send.push(data)
    },
    SEND_RECIVED(state, data){
      state.recives.push(data)
    },
    DELETE_NOTIFY(state, id){
      state = state.splice(id,1)
    }
  };
  