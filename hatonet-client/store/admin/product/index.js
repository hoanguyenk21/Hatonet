import actions from '@/store/admin/product/action'
import mutations from '@/store/admin/product/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    productes: [],
    items:[],
    show: {},
    detail: {},
  }),
  actions,
  mutations,
}
