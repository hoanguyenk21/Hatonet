import actions from '@/store/client/page/action'
import mutations from '@/store/client/page/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
  }),
  actions,
  mutations,
}