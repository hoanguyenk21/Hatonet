import actions from '@/store/admin/notify/action'
import mutations from '@/store/admin/notify/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    show: {},
    item: {},
    accounts:[],
  }),
  actions,
  mutations,
}
