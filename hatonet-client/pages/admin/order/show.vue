<template>
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card p-3">
          <div class="row">
            <div class="col-md-6">
              <ul>
                <li>Tên gói: {{ show.title }}</li>
                <li>Thời gian sử dụng: {{ item.use_time * 30 }} Ngày</li>
                <li v-if="userCookie.roles == 'admin' && show.status == 'active'">Thời gian sử dụng còn lại: {{ remainingUsageTime }} Ngày</li>
                <li>
                  Giá: {{ new Intl.NumberFormat().format(show.price_sale) }} đ
                </li>
                <li>Người mua: {{ show.user_name }}</li>
                <li>Ngày tạo hóa đơn: {{ show.created_at }}</li>
                <li >Ngày duyệt hóa đơn: {{ show.start_day }}</li>
                <div v-for="(meta,index) in show.meta" :key="index">
                  <li v-if="meta.meta_key == 'approver_name'">Người duyệt hóa đơn: {{ meta.meta_value }}</li>
                </div>
              </ul>
            </div>
            <div class="col-md-6">
              <ul><li>Nội dung gói</li></ul>
              <ul class="content">

                <li v-for="(serviceMeta,index) in item.service_meta" :key="index">
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
                      v-if="serviceMeta.meta_key == true"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
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
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    {{ serviceMeta.meta_value }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'

export default {
  components: { Paginate, StatusLabel },
  name: 'AdminAreaAccount',
  layout: 'admin.root',

  data() {
    return {
      remainingUsageTime:null,
      userCookie: {},
    }
  },

  computed: {
    ...mapState('order', ['show']),
    ...mapState('service', ['item']),
  },

  async fetch({ store, query }) {
    const id = query.id
    await store.dispatch('order/getOrderId', id) || {}
  },

  created () {
    this.userCookie = (this.$cookies.get('_user')) || {}
    this.getService();
    this.getExpireDay();
  },

  methods: {
      async getService() {
        await this.$store.dispatch('service/getServiceId', this.show.service_id) || {}
      },
      async getExpireDay(){
        if(this.show.status == "active"){
          this.remainingUsageTime = await this.$store.dispatch('orderClient/getExpire', {
            orderUsing: this.show
          })
        }
      }
  },
}
</script>

<style lang="scss" scoped>
li {
  margin-bottom: 10px;
  font-size: 16px;
}
.content{
    list-style: none;
}
</style>
