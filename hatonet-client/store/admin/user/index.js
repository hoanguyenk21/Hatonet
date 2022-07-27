import actions from '@/store/admin/user/action'
import mutations from '@/store/admin/user/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    users: [],
    user: {},
  }),
  actions,
  mutations,
}
