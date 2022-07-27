export default {
    SET_ACCOUNTS: function (state, payload) {
      state.accountsClient = payload
      // paginate
      state.paginate = payload.paginate
    },
   
  
    SHOW_ACCOUNT(state, data){
      state.showClient = data
    },
  
    DELETE_ACC(state, id){
      state.accountsClient = state.accountsClient.splice(id,1)
    },
  
    CREATE_ACC(state, data){
      state.accountsClient.push(data)
    },
  
    EDIT_ACC(state, data){
      const index = state.accountsClient.findIndex((acc) => {
        return acc.id === data.id
      })
      state.accountsClient.splice(index, 1, data)
    }
  }
  