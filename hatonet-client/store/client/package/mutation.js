export default {
  SET_PACKAGES: function (state, payload) {
    state.packagesClient = payload.data.items
    // paginate
    state.paginateClient = payload.data.paginate
  },
  SET_VNPAY: function (state, payload) {
    state.vnpay = payload.data.items
    // paginate
    state.paginateClient = payload.data.paginate
  },
  SET_PACKAGE_SHOW: function (state, payload) {
    state.packageClient = payload.data
  },

  CREATE_PACKAGE(state, data) {
    state.packagesClient.push(data)
  },

  UPDATE_PACKAGE(state, data) {
    const index = state.packagesClient.findIndex((order) => {
      return order.id === data.id
    })
    state.packagesClient.splice(index, 1, data)
  },

  DELETE_PACKAGE(state, id) {
    state.packagesClient = state.packagesClient.filter((order) => {
      return order.id !== id
    })
  },

  STOP_PACKAGE(state, data){
    const index = state.packagesClient.findIndex((order) => {
      return order.id === data.id
    })
    state.packagesClient.splice(index, 1, data)
  }
}