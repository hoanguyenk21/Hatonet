export default {
  SET_ORDERS: function (state, payload) {
    state.orders = payload.data.items
    // paginate
    state.paginate = payload.data.paginate
  },
  SET_ORDER_SHOW: function (state, payload) {
    state.show = payload.data
  },

  CREATE_ORDER(state, data) {
    state.orders.push(data)
  },

  UPDATE_ORDER(state, data) {
    const index = state.orders.findIndex((order) => {
      return order.id === data.id
    })
    state.orders.splice(index, 1, data)
  },

  DELETE_ORDER(state, id) {
    state.orders = state.orders.filter((order) => {
      return order.id !== id
    })
  },

  STOP_SERVICE(state, data){
    const index = state.orders.findIndex((order) => {
      return order.id === data.id
    })
    state.orders.splice(index, 1, data)
  }
}
