import actions from '@/store/client/package/action'
import mutations from '@/store/client/package/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginateClient: {},
    packagesClient: [],
    packageClient:{},
    vnpay:{}
  }),
  actions,
  mutations,
}
