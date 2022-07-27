import actions from '@/store/client/mail/action'
import mutations from '@/store/client/mail/mutation'

export default {
  namespaced: true,
  state: () => ({
    paginate: {},
    items:[],
    send: [],
    recived : [],
  }),
  actions,
  mutations,
}