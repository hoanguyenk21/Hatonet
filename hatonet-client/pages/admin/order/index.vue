<template>
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-bottom py-3 row">
            <div class="col-xl-6 col-12 d-flex align-items-center search-box">
              <label class="form-label">Search: </label>
              <select class="form-select ms-2" @change="selectStatus">
                <option value="" selected>Trạng thái</option>
                <option
                  v-for="(item, index) in status"
                  :key="index"
                  :value="item"
                >
                  {{ item }}
                </option>
              </select>
              <input type="text" class="form-control ms-2" placeholder="User name ..." v-model="valueSearch" />
              <button class="btn ms-2" @click="searchByUsername">Tìm kiếm</button>
            </div>
            <div class="col-xl-6 col-12 text-muted">
                Show
                <div class="mx-2 d-inline-block">
                  <select class="form-select" @change="valueRecord">
                    <option value="" selected>Open this select menu</option>
                    <option v-for="(item,index) in recordNumber" :key="index" :value="item">{{ item }}</option>
                    
                  </select>
                </div>
                entries

            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1">
                    <input
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select all invoices"
                    />
                  </th>
                  <th scope="col" class="w-1">
                    No.
                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon icon-sm text-dark icon-thick"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <polyline points="6 15 12 9 18 15"></polyline>
                    </svg>
                  </th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Price base</th>
                  <th scope="col">Price sale</th>
                  <th scope="col">Status</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Người mua /<br/> Email</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item,index) in packages" :key="index">
                  <td>
                    <input
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select invoice"
                    />
                  </td>
                  <td>{{ item.id }}</td>
                  <td>{{ item.title }}</td>
                  <td>{{ item.description }}</td>
                  <td>{{ new Intl.NumberFormat().format(item.price_base) }} VND</td>
                  <td>{{ new Intl.NumberFormat().format(item.price_sale) }} VND</td>
                  <td>
                    <StatusLabel :status="item.status"/>
                  </td>
                  <td>{{ item.qty }}</td>
                  <td>{{ item.user_name }} <br/>{{ item.user.email }}</td>
                  <td class="text-end">
                    
                      
                      
                        <button class="btn" @click="editOrder(item.id)"> Edit </button>
                        <button class="btn" @click="deleteOrder(item.id)"> Delete </button>
                    
                    
                  </td>
                  <td>
                    <nuxt-link :to="{ path: `/admin/package/show`, query: { id: item.id }}">
                      Chi tiết
                    </nuxt-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center" :class="valueRecordNumber ? 'd-none' : ''">
            <paginate
              :total="paginate.total"
              :currentPage="currentPage"
              @paginate="handlePaginate"
            />
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

const PAYLOAD = {}

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel },

  data() {
    return {
      valueSearch: "",
      valueSelect: '',
      oldValueSearch: '',
      status: ['active', 'pending', 'unactive', 'suspended', 'wait'],
      currentPage:1,
      recordNumber: [10, 25, 50],
      valueRecordNumber: null,

    }
  },

  computed: {
    ...mapState('packages',['packages','paginate']),
  },

  created () {
    this.getData();
  },

  watch: {
    valueSelect() {
      this.getData()
    },
    valueRecordNumber(){
      this.getData()
    }
  },

  methods: {
    async deleteOrder(id){
      if(confirm(`Bạn chắc chắn muốn xóa order này ?`)){
        await this.$store.dispatch('packages/remove',id)
        await this.$store.dispatch('packages/getPackageList')
      }
      return
    },

    editOrder(id){
       this.$router.push({ path: `/admin/package/edit`, query: { id: id } })
     },

    selectStatus(e) {
      this.valueSelect = e.target.value
    },

    valueRecord(e){
      this.valueRecordNumber = e.target.value
    },

    async searchByUsername() {
      if (this.valueSearch && this.valueSearch != this.oldValueSearch) {
        await this.getData()
        this.oldValueSearch = this.valueSearch
      }
      if (this.oldValueSearch && this.valueSearch == '') {
        this.getData()
        this.oldValueSearch = ''
      }
      return
    },

    async getData() {
      const payload = {
        text: this.valueSearch,
        status: this.valueSelect,
        page: this.currentPage,
        recordNumber: this.valueRecordNumber
      }
      await this.$store.dispatch('packages/getPackageList', payload) ||  []
    },

    handlePaginate: function (paged) {
      this.currentPage = paged
      this.getData()
    },

  },
}
</script>

<style lang="scss" scoped>
//responsive
@media screen and (min-width: 1200px) {
  .card-body div:last-child{
    text-align: end;
  }
}
@media screen and (max-width: 1199px) {
  .card-body div:last-child{
    margin-top: 10px;
    select{
      margin-left: 5px;
    }
  }
}

//mobile
@media screen and (max-width: 767px) {
  .search-box{
    display: unset !important;
    select, input, button{
      margin-left: 0 !important;
      margin-top: 5px;
    }
  }
}
</style>
