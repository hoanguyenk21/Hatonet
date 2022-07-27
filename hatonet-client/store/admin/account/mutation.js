export default {
  SET_ACCOUNTS: function (state, payload) {
    state.items = payload
    // paginate
    state.paginate = payload.paginate
  },
  SET_ACCOUNT_SHOW: function (state, payload) {
    state.show = payload.data
  },

  SHOW_ACCOUNT(state, data){
    state.show = data
  },

  DELETE_ACC(state, id){
    state.items = state.items.splice(id,1)
  },

  CREATE_ACC(state, data){
    state.items.push(data)
  },

  EDIT_ACC(state, data){
    const index = state.items.findIndex((acc) => {
      return acc.id === data.id
    })
    state.items.splice(index, 1, data)
  },
  SET_USERS(state, payload){
    state.users = payload
      // paginate
    state.paginateUser = payload.paginateUser
  }
}
