import actions from '@/store/client/term/action'
import mutations from '@/store/client/term/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
  }),
  actions,
  mutations,
}