import actions from '@/store/client/user/action'
import mutations from '@/store/client/user/mutation'

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
