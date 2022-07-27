<template>
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th>Họ tên</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Nội dung</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody v-for="custom_review in customerReview.data" :key="custom_review.id">
                <tr>
                  <td>
                    <a href="invoice.html" class="text-reset" tabindex="-1" v-text="custom_review.name"></a>
                  </td>
                  <td>
                    <span class="flag flag-country-gb" v-text="custom_review.email"></span>
                  </td>
                  <td>
                    <p name="description" id="" cols="30" rows="10" v-text="custom_review.phone"></p>
                  </td>
                  <td>
                    <p v-text="custom_review.message"></p>
                  </td>
                  <td>
                    <nuxt-link
                      class="btn"
                      :to="{
                        path: `/admin/customer_review/show`,
                        query: { id: custom_review.id },
                      }"
                    >
                      <i class="ti ti-alert-circle"></i>
                    </nuxt-link>
                    <button class="btn"
                      @click="remove(custom_review.id)">
                      <i class="ti ti-trash"></i>
                    </button>
                  </td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <paginate :total="customerReview.total" @paginate="paginate" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>

  import {mapState} from 'vuex'
  import Paginate from '@/components/Paginate.vue'
  import BtnCreate from '@/components/admin/BtnCreate.vue'
  export default {
    name: 'AdminAreaPost',
    layout: 'admin.root',
    components: {
      Paginate,
      BtnCreate
    },
     computed: {
      ...mapState('customerReview', ['customerReview']),
    },
    async fetch({store}) {
      try {
        await store.dispatch('customerReview/getAll')
      } catch (error) {
         this.$mixError(error)
      }
    },
    methods: {
      async remove(id) {
        if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
           await this.$store.dispatch('customerReview/remove',id)
           await this.$store.dispatch('customerReview/getAll')
        }
      },
    },
  }

</script>

<style scoped lang="scss">
.icons {
  position: absolute;
  margin-left: 100px;
  margin-top: 10px;
}
  .selectshow {
    height: 32px;
    width: 60px;
  }
.search-input{
  height: 32px;
  
}
  .tdImage {
    width: 81.88px;
    height: 59.86px;
  }
.tdImage img{
  height: 100%; 
}
  .admin .text-nowrap {
    white-space: normal !important;
  }

</style>
