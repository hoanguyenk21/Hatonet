export default {
    SET_SERVICES: function (state, payload) {
      state.items = payload.data.items;
      // paginate
      state.paginate = payload.data.paginate;
    },

    CREATE_SERVICE(state, data){
      state.items.push(data)
    },

    UPDATE_SERVICE(state, data){
      const index = state.items.findIndex((service) => {
        return service.id === data.id
      })
      state.items.splice(index, 1, data)
    },

    SERVICE_DETAIL(state, data){
      state.item = data.data
    },

    DELETE_SERVICE(state, id){
      state = state.splice(id,1)
    }
  };