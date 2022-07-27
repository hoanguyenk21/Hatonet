import actions from '@/store/admin/setting/action'
import mutations from '@/store/admin/setting/mutation'

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
