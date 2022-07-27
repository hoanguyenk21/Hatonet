export default {
  SET_NOTIFIES: function (state, payload) {
    state.items = payload.data;
  },
  SET_ACCOUNTS: function (state, payload) {
    state.accounts = payload;
  },
  DELETE_NOTIFY(state, id){
    state = state.splice(id,1)
  },
  CREATE_NOTIFIES(state, data){
    state.items.push(data)
  },

  UPDATE_NOTIFIES(state, data){
    const index = state.items.findIndex((service) => {
      return service.id === data.id
    })
    state.items.splice(index, 1, data)
  },

  NOTIFIES_DETAIL(state, data){
    state.item = data.data
  },
};
