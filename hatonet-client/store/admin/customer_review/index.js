import actions from '@/store/admin/customer_review/action'
import mutations from '@/store/admin/customer_review/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    customerReview:[],
    show: {},
  }),
  actions,
  mutations,
}