import actions from '@/store/client/account/actions'
import mutations from '@/store/client/account/mutations'

export default {
  namespaced: true,
  state: {
    paginate: {},
    accountsClient: [],
    showClient: {},
  },
  actions,
  mutations,
}
