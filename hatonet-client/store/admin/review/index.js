import actions from '@/store/admin/review/action'
import mutations from '@/store/admin/review/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    reviews: [],
    review:{}
  }),
  actions,
  mutations,
}