<template>
  <div class="container">
    <div class="content">
      <div class="title">
        <h3 class="mb-0">Chi tiết dịch vụ</h3>
      </div>
      <div class="body d-flex"> 
        <div class="service me-5">
          <h4>Chi tiết gói</h4>
          <ul>
            <li>Loại gói: {{ item.title }}</li>
            <li>
              Thời gian sử dụng : {{ usageTime }} Ngày
            </li>
            <li v-if="remainingUsageTime != null">
              Thời gian sử dụng còn lại: {{ remainingUsageTime }} Ngày
            </li>
            <li class="text-decoration-line-through">
              Giá tiền:
              {{
                new Intl.NumberFormat('vi-VN', {
                  style: 'currency',
                  currency: 'VND',
                }).format(price_base)
              }}
            </li>
            <li>
              Giá khuyến mãi:
              {{
                new Intl.NumberFormat('vi-VN', {
                  style: 'currency',
                  currency: 'VND',
                }).format(price_sale)
              }}
            </li>
          </ul>
        </div>
        <div class="user">
          <h4>Thông tin người mua</h4>
          <ul>
            <li>Tên công ty : {{ userCookie.name }}</li>
            <div v-for="(meta,index) in show.meta" :key="index">
              <li v-if="meta.meta_key == '_address'">Địa chỉ: {{ meta.meta_value }}</li>
            </div>
            <li>Số điện thoại : {{ show.phone }}</li>
          </ul>
          <div class="col-12 mt-4">
            <nuxt-link to="/" class="nav-link me-2">Quay lại</nuxt-link>
            <button @click="createOrder">Thanh toán</button>
            <button name="redirect" @click="vnpayPayment">Thanh toán VNPAY</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

const PAYLOAD = {}

export default {
  async asyncData({ $cookies, route, params, store }) {
    let price_base, price_sale, usageTime = null
    const errors = {}
    let meta = {
      approver_email: "",
      approver_name: "",
    }
 n 
    const userCookie = await $cookies.get("_user")
    const id = await params.id
    await store.dispatch('service/getServiceId', id) || {}
    await store.dispatch('account/getAccountId', userCookie.id) || {}
    const packageList = await store.dispatch('packages/getPackageList', PAYLOAD) || []
    const orderUsing = (await packageList.data.items.find(
        (x) => x.user_id == userCookie.id && x.status == 'active'
      )) || {}
    const remainingUsageTime = await params.remainingUsageTime || null

    return { userCookie, remainingUsageTime, price_base, price_sale, usageTime, errors, meta, orderUsing }
  },

  computed: {
    ...mapState('service', ['item']),
    ...mapState('account', ['show']),
    ...mapState('packages', ['packages']),
  },

  async created() {
    await this.calculate()
  },

  methods: {
    async createOrder() {
      try {
        await this.$store.dispatch('packages/create', {
          service_id: this.item.id,
          orderUsing: this.orderUsing,
          meta: this.meta
        })
        this.$router.push({ name: 'order-billing', params: { price: this.price_sale } })
      } catch (error) {
        this.errors = this.$mixError(error)
      }
      
    },
    async vnpayPayment(){
       await this.$store.dispatch('packages/getVnpayPayment', {
          id_packages: Math.random(),
          service_id: this.item.id,
          orderUsing: this.orderUsing,
          meta: this.meta
        })
    },
    calculate() {
      
      if (parseFloat(this.orderUsing.price_base) < parseFloat(this.item.price_base)) {
        this.price_base = parseFloat(this.item.price_base) - parseFloat(this.orderUsing.price_base)
        this.price_sale = parseFloat(this.item.price_sale) - parseFloat(this.orderUsing.price_sale)
      } else if(parseFloat(this.orderUsing.price_base) > parseFloat(this.item.price_base)){
        this.price_sale = 0
        this.price_base = parseFloat(this.item.price_base)
      } else if (Object.keys(this.orderUsing).length === 0) {
        this.price_base = parseFloat(this.item.price_base)
        this.price_sale = parseFloat(this.item.price_sale)
      } else {
        this.price_sale = 0
        this.price_base = 0
      }

      this.usageTime = parseInt(this.item.use_time) * 30
    },

  },

}
</script>

<style scoped lang="scss">
.container {
  padding: 100px 0;
}
.content {
  max-width: 750px;
  margin: 0 auto;
  background: #fff;
  box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
  transition: all 0.3s;
  &:hover{
    box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  }


  .body {
    border-top: 2px solid lightgrey;
    .service,
    .user {
      padding: 20px;
    }
    .user {
      border-left: 2px solid lightgrey;
    }
  }
}
.nav-link {
  text-decoration: none;
  border: 1px solid #123456;
  padding: 10px 25px;
}
button {
  padding: 10px 25px 9px;
  border: 1px solid #123456;
  color: #0d6efd;
}
.title {
  padding: 20px;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  font-size: 17px;
  margin: 10px 0;
}
.text-decoration-line-through {
  text-decoration: line-through;
}


//responsive
//mobile
@media screen and (max-width: 767px) {
  .d-flex{
    display: block !important;
  }
  .user{
    border-top: 2px solid lightgrey;
    border-left: 0 !important;
  }
}
</style>
