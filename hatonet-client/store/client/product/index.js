import actions from '@/store/client/product/action'
import mutations from '@/store/client/product/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    show: {},
  }),
  actions,
  mutations,
}
