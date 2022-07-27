import actions from '@/store/admin/post/action'
import mutations from '@/store/admin/post/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    show:{},
    id: [],
  }),
  actions,
  mutations,
}
