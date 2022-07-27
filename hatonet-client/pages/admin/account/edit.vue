<template>
  <section>
    <div class="row">

      <div class="col-md-6 col-12">
        <div class="card">
          <div class="card-body p-2" :class="show.id == userCookie.id ? 'd-none' : ''">
            <div class="mb-3">
              <label class="form-label">Tên tài khoản <span>*</span></label>
              <input type="text" class="form-control" v-model="show.name">
              <div class="alert alert-danger" v-if="errors && errors.name">
                {{ errors.name[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Số điện thoại <span>*</span></label>
              <input v-model="show.phone" type="number" class="form-control"
                :class="[{ 'is-invalid': errors.phone }]" />
              <span class="text-danger alertSpan" v-if="errors && errors.phone">
                {{ errors.phone[0] }}
              </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Trạng thái <span>*</span></label>
              <v-select-tree :options="status" v-model="show.status" />
              <div class="alert alert-danger" v-if="errors && errors.status">
                {{ errors.status[0] }}
              </div>
            </div>
            <div class="col-12 align-items-center mb-3">
              <button class="btn" @click="editAcc">
                <span>Cập nhật</span>
              </button>
              <nuxt-link to="/admin/account" class="btn">Quay lại</nuxt-link>
            </div>
          </div>

          <div class="card-body p-2" :class="show.id == userCookie.id ? '' : 'd-none'">
            <div class="mb-3">
              <label class="form-label">Mật khẩu hiện tại <span>*</span></label>
              <input type="password" class="form-control" v-model="changePwd.current_password">
              <div class="alert alert-danger" v-if="errors && errors.current_password">
                {{ typeof errors.current_password == 'object' ? errors.current_password[0] : "" }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Mật khẩu mới <span>*</span></label>
              <input type="password" class="form-control" v-model="changePwd.new_password">
              <div class="alert alert-danger" v-if="errors && errors.new_password">
                {{ errors.new_password[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Xác nhận mật khẩu <span>*</span></label>
              <input type="password" class="form-control" v-model="changePwd.confirm_password">
              <div class="alert alert-danger" v-if="errors && errors.confirm_password">
                {{ errors.confirm_password[0] }}
              </div>
            </div>
            <div class="col-12 align-items-center mb-3">
              <button class="btn" @click="editPassword">
                <span>Cập nhật</span>
              </button>
              <nuxt-link to="/admin/account" class="btn">Quay lại</nuxt-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'AdminAreaAccount',
  layout: 'admin.root',
  data() {
    return {
      status: [
        { id: 1, label: 'pending' },
        { id: 2, label: 'expired' },
        { id: 3, label: 'active' },
        { id: 4, label: 'suspended' },
      ],
      errors:{},
      userCookie: {},
      changePwd: {
        current_password:"",
        new_password:"",
        confirm_password:""
      }
    }
  },
  computed: {
    ...mapState('account', ['show']),
  },
  async fetch({ store, query }) {
    const id = query.id
    await store.dispatch('account/getAccountId', id)
  },
  created () {
    this.userCookie = this.$cookies.get("_user") || {};
  },

  methods: {
    async editAcc(){
      try {
        await this.$store.dispatch('account/updateAccount', this.show)
        await this.$router.push({ path: "/admin/account" })
        this.$toast.success('Cập nhật thành công !')
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Cập nhật thất bại !')
      }
    },
    async editPassword(){
      try {
        await this.$store.dispatch('account/changPassword', this.changePwd)
        await this.$router.push({ path: "/admin/account" })
        this.$toast.success('Đổi mật khẩu thành công !')
      } catch (error) {
        this.$toast.error('Đổi mật khẩu thất bại !')
        this.errors = this.$mixError(error)
        if(typeof this.errors.current_password == 'string'){
          alert(this.errors.current_password)
        }
      }
    },

  },
}
</script>

<style lang="scss" scoped>
.alert{
  box-shadow: none !important;
  color: #fb5858;
}
.alert-danger {
  padding: 0;
  border: 0;
  margin-top: 5px;
}
label span{
  color: crimson;
}
</style>
