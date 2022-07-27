import Vuex from 'vuex'
export const strict = false
import state from '@/store/state'
import actions from '@/store/actions'
import mutations from '@/store/mutations'

// modules
import account from '@/store/admin/account'
import notify from '@/store/admin/notify'
import packages from '@/store/admin/package'
import page from '@/store/admin/page'
import post from '@/store/admin/post'
import product from '@/store/admin/product'
import setting from '@/store/admin/setting'
import ticket from '@/store/admin/ticket'
import order from '@/store/admin/order'
import term from '@/store/admin/term'
import category from '@/store/admin/category'
import service from '@/store/admin/service'
import review from '@/store/admin/review'
import follow from '@/store/admin/follow'
import user from '@/store/admin/user'
import customer_review from '@/store/admin/customer_review'
import apply from '@/store/admin/apply'

// modules client
import userClient from '@/store/client/user'
import pageClient from '@/store/client/page'
import postClient from '@/store/client/post'
import productClient from '@/store/client/product'
import packgesClient from '@/store/client/package'
import categoryClient from '@/store/client/category'
import serviceClient from '@/store/client/service'
import termClient from '@/store/client/term'
import mailClient from '@/store/client/mail'
import accountClient from '@/store/client/account'

const createStore = () => {
  return new Vuex.Store({
    state,
    actions,
    mutations,
    modules: {
      account,
      user,
      apply,
      notify,
      packages,
      page,
      post,
      order,
      product,
      setting,
      ticket,
      term,
      category,
      service,
      review,
      follow,
      customer_review,
      userClient,
      pageClient,
      postClient,
      productClient,
      packgesClient,
      categoryClient,
      serviceClient,
      termClient,
      mailClient,
      accountClient,
    },
  })
}
export default createStore
