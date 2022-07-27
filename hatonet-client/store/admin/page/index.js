import actions from '@/store/admin/page/action'
import mutations from '@/store/admin/page/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    pages: [],
    show:{},
    id: [],
  }),
  actions,
  mutations,
}
