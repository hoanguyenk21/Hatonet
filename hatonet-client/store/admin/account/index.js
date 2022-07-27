import actions from '@/store/admin/account/action'
import mutations from '@/store/admin/account/mutation'

export default {
  namespaced: true,
  state: {
    paginate: {},
    items: [],
    show: {},
    users:[],
    user:{},
    paginateUser:{}
  },
  actions,
  mutations,
}
