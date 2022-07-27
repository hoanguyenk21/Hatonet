import actions from '@/store/admin/category/action'
import mutations from '@/store/admin/category/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    categories: [],
    category: [],
  }),
  actions,
  mutations,
}
