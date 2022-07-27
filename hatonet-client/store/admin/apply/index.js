import actions from '@/store/admin/apply/action'
import mutations from '@/store/admin/apply/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    applies: [],
    apply: {},
  }),
  actions,
  mutations,
}
