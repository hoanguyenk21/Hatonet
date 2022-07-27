import actions from '@/store/admin/order/action'
import mutations from '@/store/admin/order/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    orders: [],
    show: {},
  }),
  actions,
  mutations,
}
