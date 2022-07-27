import actions from '@/store/client/category/action'
import mutations from '@/store/client/category/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
  }),
  actions,
  mutations,
}