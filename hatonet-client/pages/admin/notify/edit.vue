<template>
  <section>
    <div class="row" v-if="$cookies.get('_user').id == 1">
      <div class="col-4 col-md-4 col-xl-4">
        <validation-observer v-slot="{ valid, handleSubmit }">
          <div class="mb-3">
            <label class="form-label required">Tiêu đề</label>
            <validation-provider v-slot="{ errors }" rules="required">
              <input class="form-control" v-model="notifys.title" placeholder="Tiêu đề" />
              <span class="message">{{ errors[0] }}</span>
            </validation-provider>
          </div>
          <div class="mb-3">
            <label class="form-label required">type</label>
            <select v-model="notifys.type" class="form-control" placeholder="Hệ thống">
              <option value="Hệ thống" selected>Hệ thống</option>
              <option value="Quảng cáo">Quảng cáo</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label required">Nội dung</label>
            <validation-provider v-slot="{ errors }" rules="required">
              <input class="form-control" v-model="notifys.content" placeholder="Nội dung" />
              <span class="message">{{ errors[0] }}</span>
            </validation-provider>
          </div>
          <div class="mb-3">
            <label class="form-label required">Người nhận </label>
            <select v-model="isSelectAll" class="form-control">
              <option :value="true">Chọn tất cả</option>
              <option :value="false">Theo nhóm người nhận</option>
            </select>
            <template v-if="!isSelectAll">
              <validation-provider v-slot="{ errors }" rules="required">
                <vue-multiselect v-model="userReceives" :options="user" track-by="id" label="name" :multiple="true"
                  :taggable="true" placeholder="" /><span class="message">{{ errors[0] }}</span>
              </validation-provider>
            </template>
          </div>
          <div class="mb-3">
            <label class="form-label required">
              <span>Chi tiết</span>
            </label>
            <validation-provider v-slot="{ errors }" rules="required">
              <textarea v-model="notifys.description" :class="[{ 'is-invalid': errors.description }]"
                class="form-control" name="example-textarea-input" rows="6" placeholder="Chi tiết">
              </textarea><span class="message">{{ errors[0] }}</span>
            </validation-provider>
          </div>
          <!-- <div class="mb-3">
            <button @click="handleSubmit(onSubmit(valid))" class="btn btn-primary">
              Tạo thông báo
            </button>
          </div> -->
                  <div class="row">
          <div class="col-md-4">
            <nuxt-link to="/admin/notify" class="back"> <button class="btn btn-primary btn-l">Quay lại</button>
            </nuxt-link>
          </div>
          <div class="col-md-4 ms-auto"> <button class="btn btn-primary btn-r" @click="handleSubmit(onSubmit(valid))">Lưu thông báo</button>
          </div>
        </div>
                    <!-- <div class="row">
    <div class="col-md-4"> <nuxt-link to="/admin/notify"> <button style="background-color: black;" class="btn btn-primary" >Quay lại</button></nuxt-link></div>
    <div class="col-md-4 ms-auto"> <button style="background-color: black; float: right;" class="btn btn-primary" @click="handleSubmit(onSubmit(valid))">Lưu thẻ</button></div>
  </div> -->
        </validation-observer>
      </div>
    </div>
  </section>
</template>
<script>
import { mapState } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'
import axios from 'axios'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel },
  data: () => ({
    notifys: {},
    user: [],
    errors: {},
    itemId: null,
    userReceives: [],
    isSelectAll: false,
  }),
  computed: {
    ...mapState('notify', ['items']),
  },
  async fetch() {
    try { 
      this.itemId = this.$route.query.id
      let resp = await this.$store.dispatch('notify/getNotifyId', this.itemId)
      this.notifys = resp.data
      this.userReceives = JSON.parse(this.notifys.user_receive)
      const user = this.$cookies.get('_user')
      this.notifys.user_id = user.id
      const userid = (await this.$store.dispatch('account/getAccount')).data
      this.user = userid.data.filter((item) => item.id != 1)
      if (this.user.length == this.userReceives.length) {
        this.isSelectAll = true
      }
    } catch (error) {
      console.error(error)
    }
  },
  methods: {
    async onSubmit(valid) {
      if (!valid) {
        return;
      }
      try {
        if (this.isSelectAll) {
          this.userReceives = this.user
        }
        let userIds = []
        this.userReceives.forEach((item) => {
          userIds.push({
            id: item.id,
            name: item.name,
          })
        })
        const formsData = {
          id: this.notifys.id,
          title: this.notifys.title,
          description: this.notifys.description,
          content: this.notifys.content,
          type: this.notifys.type,
          user_id: this.notifys.user_id,
          user_receive: JSON.stringify(userIds),
        }
        const resp = await this.$store.dispatch('notify/updateNotify', formsData)
        this.$router.push({ path: `/admin/notify` })
        this.$toast.success('Sửa thông báo thành công !')
      } catch (error) {
        console.error(error)
        this.$toast.error('Sửa thông báo không thành công !')
      }
    },
  },
}
</script>
<style scoped lang="scss">
.editor .quillWrapper .ql-snow.ql-toolbar button svg {
  svg {
    width: 15px;
    height: 15px;
  }
}
.back {
  text-decoration: none !important;
}

.btn-l {
  background-color: black !important;
}

.btn-r {
  background-color: black !important;
  float: right;
}

.error{
  background-color:#CC0000 !important ;
}
</style>
