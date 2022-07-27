import actions from '@/store/admin/follow/action'
import mutations from '@/store/admin/follow/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    follows: [],
    follow:{}
  }),
  actions,
  mutations,
}