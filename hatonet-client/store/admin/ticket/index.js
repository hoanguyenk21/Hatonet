import actions from '@/store/admin/ticket/action'
import mutations from '@/store/admin/ticket/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    show: {},
  }),
  actions,
  mutations,
}
