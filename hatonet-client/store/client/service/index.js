import actions from '@/store/client/service/action'
import mutations from '@/store/client/service/mutation'

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
