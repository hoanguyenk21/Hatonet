import actions from '@/store/admin/term/action'
import mutations from '@/store/admin/term/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    item: [],
  }),
  actions,
  mutations,
}
