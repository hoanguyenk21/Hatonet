<template>
  <div class="page-price">
    <div class="container pt-5 pb-5">
      <h2>Chi tiết dịch vụ</h2>
      <div class="row align-items-center">
        <div class="col-md-6 col-12">
          <div class="list">
            <ul class="list-group list-group-flush ps-0">
              <div class="d-flex align-items-center justify-content-between">
                <span>Tên gói :</span>
                <span>{{ item.title }}</span>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <span class="description-title">Mô tả :</span>
                <span class="description-content">{{ item.description }}</span>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <span>Giá gốc :</span>
                <span
                  >{{ new Intl.NumberFormat().format(item.price_base) }} đ</span
                >
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <span>Giá sale :</span>
                <span
                  >{{ new Intl.NumberFormat().format(item.price_sale) }} đ</span
                >
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <span>Thời gian sử dụng :</span>
                <span>{{ calculate() }} ngày</span>
              </div>
              <div class="d-flex justify-content-between">
                <span>Nội dung :</span>
                <span>
                  <ul class="text-end">
                    <li v-for="meta in item.service_meta" :key="meta.id">
                      {{ meta.meta_value }}
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon me-1 text-success"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        v-if="meta.meta_key == true"
                      >
                        <path
                          stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"
                        ></path>
                        <path d="M5 12l5 5l10 -10"></path>
                      </svg>
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon me-1 text-danger"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        v-else
                      >
                        <path
                          stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"
                        ></path>
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </li>
                  </ul>
                </span>
              </div>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="div-img">
            <img src="@/assets/images/price.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'price-detail',
  async asyncData({ store, query }) {
    const id = (await query.id) || ''
    await store.dispatch('service/getServiceId', id)
    const usageTime = null
    return { usageTime }
  },

  computed: {
    ...mapState('service', ['item']),
  },

  methods: {
    calculate() {
      this.usageTime = parseInt(this.item.use_time) * 30
      return this.usageTime
    },
  },
}
</script>

<style lang="scss" scoped>
img {
  max-width: 100%;
}
.text-end {
  text-align: end;
  li {
    font-size: 16px;
    font-weight: normal;
  }
}
.text-success {
  color: #2fb344;
}
.text-danger {
  color: #d63939;
}
ul {
  list-style: none;
  div {
    border-bottom: 1px solid lightgrey;
    font-size: 18px;
    padding-left: 20px;
    padding-right: 20px;
    font-weight: 500;
    margin: 20px 0;
    padding-bottom: 5px;
  }
}
.list{
  box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;
  background: #fff;
  padding: 20px;
  border-radius: 15px;
}
.description-title{
  white-space: nowrap;
    margin-right: 10px;
}
.description-content{
  text-align: right;
}
//responsive
//mobile
@media screen and (max-width: 767px) {
  .div-img {
    display: none;
  }
}
</style>
