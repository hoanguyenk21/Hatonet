export default {
  SET_PACKAGES: function (state, payload) {
    state.packages = payload.data.items
    // paginate
    state.paginate = payload.data.paginate
  },
  SET_PACKAGE_SHOW: function (state, payload) {
    state.package = payload.data
  },
  VNPAY_PAYMENT(state, data) {
    state.packages.push(data)
  },
  CREATE_PACKAGE(state, data) {
    state.packages.push(data)
  },

  UPDATE_PACKAGE(state, data) {
    const index = state.packages.findIndex((order) => {
      return order.id === data.id
    })
    state.packages.splice(index, 1, data)
  },

  DELETE_PACKAGE(state, id) {
    state.packages = state.packages.filter((order) => {
      return order.id !== id
    })
  },

  STOP_PACKAGE(state, data){
    const index = state.packages.findIndex((order) => {
      return order.id === data.id
    })
    state.packages.splice(index, 1, data)
  }
}