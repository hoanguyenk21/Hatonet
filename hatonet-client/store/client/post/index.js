import actions from '@/store/client/post/action'
import mutations from '@/store/client/post/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
  }),
  actions,
  mutations,
}
