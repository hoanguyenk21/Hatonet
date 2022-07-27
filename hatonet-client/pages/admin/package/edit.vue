<template>
  <div class="container">
    <h3>Sửa hóa đơn</h3>
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-3">
          <label class="form-label">Tên gói</label>
          <input v-model="package.title" type="text" class="form-control" disabled/>
        </div>
        <div class="mb-3">
          <label class="form-label">Mô tả</label>
          <textarea
            disabled
            class="form-control"
            rows="5"
            v-model="package.description"
          ></textarea>
        </div>
        <p>
          <span>Người mua: </span><strong>{{ package.user_name }}</strong>
        </p>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3">
          <label class="form-label">Trạng thái</label>
          <select class="form-select" v-model="package.status" >
            <option v-for="(item, index) in status" :key="index" :value="item">
              {{ item }}
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Giá</label>
          <input v-model="package.price_base" type="number" class="form-control" disabled />
        </div>
        <div class="mb-3">
          <label class="form-label">Giá khuyến mãi</label>
          <input v-model="package.price_sale" type="number" class="form-control" disabled />
        </div>

        <button class="btn btn-primary float-right" @click="updateOrder(package)">
          Thay đổi
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

const PAYLOAD = {}

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',

  data() {
    return {
      status: ['active', 'pending', 'unactive', 'wait', 'suspended'],
      userCookie: this.$cookies.get('_user'),
      orderUsing: {},
      filterOrderUser: [],
      errors:{},
      remainingUsageTime: null,
      meta:{
        approver_email: this.$cookies.get('_user').email,
        approver_name: this.$cookies.get('_user').name,
      },
      valueRecordNumber: null,
    }
  },

  computed: {
    ...mapState('packages', ['packages','package']),
    ...mapState('packgesClient', ['packageClient']),
  },

  async fetch({ store, query }) {
    const orderId = query.id
    await store.dispatch('packages/getPackageId', orderId) || {}
    await store.dispatch('packages/getPackageList', PAYLOAD) || []
  },

  async created() {
    this.filterOrderUser =
      (await this.packages.filter((order) => {
        return order.user_id == this.package.user_id
      })) || []
    this.orderUsing =
      (await this.filterOrderUser.find((order) => order.status == 'active')) ||
      {}
    await this.$store.dispatch('packgesClient/getPackageId', this.orderUsing.id) || {}
    this.getExpiredDay(this.orderUsing)
  },

  methods: {
    async updateOrder(order) {
      try {
        await this.$store.dispatch('packages/update', {
          id: order.id,
          body:{
            idOfActive: this.orderUsing.id,
            order: order,
            remainingUsageTime: this.remainingUsageTime,
            meta: this.meta
          }
        })
        await this.$router.push({ path: '/admin/order' })
        this.$toast.success('Cập nhật thành công !')
      } catch (error) {
        this.$toast.error('Có lỗi xảy ra !')
        this.errors = this.$mixError(error)
      }
    },

    async getExpiredDay(orderUsing) {
      if(Object.keys(this.orderUsing).length != 0){
        this.remainingUsageTime = await this.$store.dispatch('packgesClient/getExpire', {
          orderUsing: orderUsing
        })
      }
    },
  },
}
</script>

<style lang="scss" scoped>
@media screen and (min-width: 767px) {
  .float-right {
    float: right;
  }
}
</style>
