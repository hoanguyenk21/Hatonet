<template>
  <div class="container pt-4 pb-4">
    <div class="brand-section">
      <div class="row align-items-center">
        <div class="col-6">
          <img src="@/assets/images/hatonet.svg" alt="" />
        </div>
        <div class="col-6">
          <div class="company-details">
            <p class="text-white"><a href="mailto:contact@hachinet.com">contact@hachinet.com</a></p>
            <p class="text-white">(+84) 24-6290-0388</p>
          </div>
        </div>
      </div>
    </div>

    <div class="body-section">
      <div class="row">
        <div class="col-6">
          <h2 class="heading">Hóa đơn No.: 001</h2>
          <p class="sub-heading">Thời gian đặt hàng: {{ new Date().toLocaleString() }}</p>
          <p class="sub-heading">Email Address: {{ show.email }}</p>
        </div>
        <div class="col-6">
          <p class="sub-heading">Tên công ty: {{ show.name }}</p>
          <div v-for="(meta,index) in show.meta" :key="index">
            <li v-if="meta.meta_key == '_address'">Địa chỉ: {{ meta.meta_value }}</li>
          </div>
          <p class="sub-heading">Số điện thoại: {{ show.phone }}</p>
        </div>
      </div>
    </div>

    <div class="body-section">
      <h3 class="heading">Thông tin hóa đơn</h3>
      <br />
      <table class="table-bordered">
        <thead>
          <tr>
            <th class="w-20">Loại gói</th>
            <th class="w-20">Mô tả</th>
            <th class="w-20">Thời gian sử dụng</th>
            <th class="w-20">Giá</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ item.title }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.use_time }} Tháng</td>
            <td>{{ new Intl.NumberFormat().format(price) }} VND</td>
          </tr>
        </tbody>
      </table>
      <br />
      <h3 class="heading">Phương thức thanh toán: Thanh toán khi nhận hàng</h3>
      <h3 class="heading">Tình trạng: <span>Đã thanh toán</span></h3>
    </div>

    <div class="body-section">
      <p class="d-inline-block">&copy; Copyright 2022 - Hatonet. All rights reserved. </p>
      <a href="https://www.hachinet.com/" target="_blank" class="nav-link">www.hachinet.com</a>
    </div>

    <div class="thank-you d-flex justify-content-between align-items-center mt-3">
      <p>Cảm ơn quý khách đã sử dụng dịch vụ. Mọi thắc mắc xin vui lòng liên hệ số điện thoại in trên hóa đơn. </p>
      <p class="mb-0">Quay lại 
        <nuxt-link to="/price" class="nav-link">Trang chủ</nuxt-link>
        hoặc chuyển đến 
        <nuxt-link to="/admin/package" class="nav-link">Trang quản trị</nuxt-link>
      </p>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  async asyncData({ $cookies, params, store,query }) {
    console.log(query);
    const price = params.price
    const userCookie = $cookies.get("_user")
    await store.dispatch('account/getAccountId', userCookie.id)
    
    return { userCookie, price }
  },

  computed: {
    ...mapState('service', ['item']),
    ...mapState('account', ['show']),
  },

  methods: {},
}
</script>

<style scoped lang="scss">
h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 0;
  padding: 0;
}
p {
  margin: 0;
  padding: 0;
}
img {
  max-width: 150px;
  background: #fff;
}
.container .body-section:nth-child(4){
  a{
    float: right;
  }
}
.brand-section {
  background-color: #ff6215;
  padding: 10px 40px;
}
.logo {
  width: 50%;
}

.row {
  display: flex;
  flex-wrap: wrap;
}
.col-6 {
  width: 50%;
  flex: 0 0 auto;
}
.text-white,a {
  color: #fff;
}
.company-details {
  float: right;
  text-align: right;
}
.body-section {
  padding: 16px;
  border: 1px solid gray;
}
.heading {
  font-size: 20px;
  margin-bottom: 08px;
}
.sub-heading {
  color: #262626;
  margin-bottom: 05px;
}
.nav-link{
  color: #ff6215;
}
table {
  background-color: #fff;
  width: 100%;
  border-collapse: collapse;
}
table thead tr {
  border: 1px solid #111;
  background-color: #f2f2f2;
}
table td {
  vertical-align: middle !important;
  text-align: center;
}
table th,
table td {
  padding-top: 08px;
  padding-bottom: 08px;
}
.table-bordered {
  box-shadow: 0px 0px 5px 0.5px gray;
}
.table-bordered td,
.table-bordered th {
  border: 1px solid #dee2e6;
}
.text-right {
  text-align: end;
}
.w-20 {
  width: 20%;
}
.float-right {
  float: right;
}


//responsive
//tablet
@media screen and (max-width: 1199px) {
  .d-flex{
    display: block !important;
  }
}

//mobile
@media screen and (max-width: 575px) {
  .brand-section {
    padding: 10px 15px;
  }
  .container .body-section:nth-child(4){
    a{
      float: unset;
    }
  }
}
</style>
