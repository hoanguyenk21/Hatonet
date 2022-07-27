import actions from '@/store/admin/package/action'
import mutations from '@/store/admin/package/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    packages: [],
    package: {},
  }),
  actions,
  mutations,
}
