import actions from '@/store/admin/service/actions'
import mutations from '@/store/admin/service/mutations'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items: [],
    item:{}
  }),
  actions,
  mutations,
}
