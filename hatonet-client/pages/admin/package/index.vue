<template>
  <section>
    <div class="row mb-3"></div>
    <div class="row">
      <div class="col-12">
        <div class="row row-cards">
          <div
            class="col-sm-6 col-lg-3"
            v-for="item in items"
            :key="item.id"
            :class="item.status != 'active' ? 'd-none' : ''"
          >
            <div class="card card-md h-100" v-if="item.status == 'active'">
              <div
                v-if="item.title == 'Premium'"
                class="ribbon ribbon-top ribbon-bookmark bg-green"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-filled"
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
                  <path
                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                  ></path>
                </svg>
              </div>
              <div class="card-body text-center">
                <div class="text-uppercase text-muted font-weight-medium">
                  {{ item.title }}
                </div>
                <div
                  class="display-6 fw-bold my-3 text-decoration-line-through"
                >
                  {{ new Intl.NumberFormat().format(item.price_base) }} VND
                </div>
                <div class="display-6 fw-bold my-3">
                  {{ new Intl.NumberFormat().format(item.price_sale) }} VND
                </div>
                <ul class="list-unstyled lh-lg">
                  <!-- <li><strong>10</strong> Users</li> -->
                  <li v-for="(meta, index) in item.service_meta" :key="index">
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

                    {{ meta.meta_value }}
                  </li>
                </ul>
                <div class="text-center mt-4">
                  <div v-show="userCookie.roles != 'admin'">
                    <div
                      v-if="
                        orderUsing.service_id == item.id &&
                        orderUsing.status == 'active'
                      "
                    >
                      <button disabled class="btn btn-green w-100">
                        Đang sử dụng
                      </button>
                      <button
                        class="btn btn-danger w-100 mt-1"
                        @click="destroyService(orderUsing)"
                      >
                        Ngừng sử dụng
                      </button>
                    </div>
                    <div v-else>
                      <button
                        class="btn btn-green w-100"
                        @click="redirectToService(item)"
                        :disabled="isDisabledBtn"
                        v-if="isShowBtnRegister(item.id)"
                      >
                        Đăng ký ngay
                      </button>
                      <button
                        v-if="isShowBtnPending(item.id)"
                        disabled
                        class="btn btn-green w-100"
                      >
                        Chờ xử lý
                      </button>
                    </div>
                    <!--  service announcement is about to expire  -->
                    <div
                      class="alert alert-warning mt-2"
                      role="alert"
                      v-if="isShowAboutToExpire(item.id)"
                    >
                      Sắp hết hạn !
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- =========== Transaction history area =========== -->
          <div class="col-12">
            <div class="card card-md">
              <div class="card-body">
                <div class="row align-items-center">
                  <div
                    :class="userCookie.roles == 'admin' ? 'col-md-6' : 'col-8'"
                  >
                    <h2 class="h3">Lịch sử giao dịch</h2>
                  </div>

                  <div
                    class="d-flex align-items-center search-box"
                    :class="userCookie.roles == 'admin' ? 'col-md-6' : 'col-4'"
                  >
                    Search:
                    <select
                      class="form-select me-2 ms-2 mt-2"
                      @change="selectStatus"
                    >
                      <option value="" selected>Trạng thái</option>
                      <option
                        v-for="(itemStatus, index) in statusOrder"
                        :key="index"
                        :value="itemStatus"
                      >
                        {{ itemStatus }}
                      </option>
                    </select>

                    <input
                      v-model="valueSearch"
                      type="text"
                      class="form-control ms-2 mt-2"
                      placeholder="User name ..."
                      v-if="userCookie.roles == 'admin'"
                    />
                    <button
                      v-if="userCookie.roles == 'admin'"
                      class="btn ms-2 mt-2"
                      @click="searchByAdmin"
                    >
                      Tìm kiếm
                    </button>
                  </div>
                </div>

                <div class="table-responsive mt-3">
                  <table
                    class="table card-table table-vcenter text-nowrap datatable"
                  >
                    <thead>
                      <tr>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian mua</th>
                        <th scope="col" v-if="userCookie.roles != 'admin'">
                          Thời gian sử dụng còn lại
                        </th>
                        <th scope="col">Thời gian ngừng sử dụng</th>
                        <th scope="col">
                          Người mua /<br />
                          Email
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="order in packagesClient"
                        :key="order.id"
                        v-show="order.user_id == userCookie.id"
                      >
                        <td>{{ order.title }}</td>
                        <td>
                          {{ new Intl.NumberFormat().format(order.price_sale) }}
                          VND
                        </td>
                        <td><status-label :status="order.status" /></td>
                        <td>{{ order.created_at }}</td>
                        <td v-if="order.status == 'active'">
                          {{ remainingUsageTime }} Ngày
                        </td>
                        <td v-else></td>
                        <td v-if="order.status == 'unactive'">
                          {{ order.updated_at }}
                        </td>
                        <td v-else></td>
                        <td>
                          {{ order.user_name }} <br />
                          {{ order.user.email }}
                        </td>
                        <td>
                          <button
                            v-show="order.status == 'pending'"
                            class="btn btn-danger"
                            @click="cancelOrder(order.id)"
                          >
                            Hủy đơn hàng
                          </button>
                          <p class="m-0" v-show="order.status == 'unactive'">
                            Đã ngừng sử dụng
                          </p>
                        </td>
                        <td>
                          <nuxt-link
                            :to="{
                              path: `/admin/package/show`,
                              query: { id: order.id },
                            }"
                          >
                            Chi tiết
                          </nuxt-link>
                        </td>
                      </tr>

                      <tr
                        v-for="(order, index) in packages"
                        :key="index"
                        v-show="userCookie.roles == 'admin'"
                      >
                        <td>{{ order.title }}</td>
                        <td>
                          {{ new Intl.NumberFormat().format(order.price_sale) }}
                          VND
                        </td>
                        <td>
                          <status-label :status="order.status" />
                        </td>
                        <td>{{ order.created_at }}</td>
                        <td v-if="order.status == 'unactive'">
                          {{ order.updated_at }}
                        </td>
                        <td v-else></td>
                        <td>
                          {{ order.user_name }} <br />
                          {{ order.user.email }}
                        </td>
                        <td>
                          <nuxt-link
                            :to="{
                              path: `/admin/package/show`,
                              query: { id: order.id },
                            }"
                          >
                            Chi tiết
                          </nuxt-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div
                  v-if="userCookie.roles == 'admin'"
                  class="card-footer d-flex align-items-center"
                >
                  <paginate
                    :total="paginate.total"
                    :currentPage="paginate.current"
                    @paginate="handlePaginate"
                  />
                </div>
                <div v-else class="card-footer d-flex align-items-center">
                  <paginate
                    :total="paginateClient.total"
                    :currentPage="paginateClient.current"
                    @paginate="handlePaginate"
                    v-if="userCookie.roles == 'admin'"
                  />
                  <paginate
                    :total="paginateClient.total"
                    :currentPage="currentPage"
                    @paginate="handlePaginate"
                    v-else
                  />
                </div>
              </div>
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

const STATUS = {
  ACTIVE: 'active',
  PENDING: 'pending',
}

const PAYLOAD = {}

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel },

  data() {
    return {
      userCookie: {},
      orderUsing: {},
      valueSearch: '',
      oldValueSearch: '',
      selectStatusOrder: '',
      remainingUsageTime: null,
      statusOrder: ['active', 'unactive', 'wait', 'pending', 'suspended'],
      currentPage: 1,
      packageUser:[]
    }
  },

  computed: {
    ...mapState('service', ['items']),
    ...mapState('packages', ['packages', 'paginate']),
    ...mapState('packgesClient',['packagesClient','paginateClient']),

    isShowPackagePending() {
      return (
        this.packages.find((order) => order.status == STATUS.PENDING) || {}
      )
    },

    isDisabledBtn() {
      if (this.isShowPackagePending.status) {
        return true
      } else {
        return false
      }
    },

    isShowBtnPending() {
      return (serviceId) => {
        return serviceId == this.isShowPackagePending.service_id
      }
    },

    isShowBtnRegister() {
      return (serviceId) => {
        return this.isShowPackagePending.service_id != serviceId
      }
    },
  },

  async fetch({ store }) {
    ;(await store.dispatch('service/getServiceList')) || []
    await store.dispatch('packages/getPackageList', PAYLOAD) || []
  },

  async created() {
    this.userCookie = (await this.$cookies.get('_user')) || {}
    await this.getData();
    if(this.userCookie.roles != 'admin'){
      this.orderUsing = (await this.packagesClient.find((x) => x.user_id == this.userCookie.id && x.status == 'active')) || {}
    }
    this.packageUser = await this.packages.filter((order) => {
      return order.user_id == this.userCookie.id
    }) || []
    if(Object.keys(this.orderUsing).length != 0){
      this.getExpiredDay(this.orderUsing)
      this.autoStop(this.orderUsing)
    }
  },

  watch: {
    selectStatusOrder() {
      this.getData()
    },
  },

  methods: {
    redirectToService(service) {
      if (
        Object.keys(this.orderUsing).length === 0 ||
        this.orderUsing.status == 'pending'
      ) {
        this.$router.push({
          path: `/order/${service.id}`,
          params: { id: service.id },
        })
      } else {
        if (
          confirm(
            `Bạn đang sử dụng gói ${this.orderUsing.title}. Bạn chắc chắn muốn chuyển sang gói ${service.title} ?`
          )
        ) {
          this.$router.push({
            name: 'order-id',
            params: {
              remainingUsageTime: this.remainingUsageTime,
              id: service.id,
            },
          })
        }
        return
      }
    },

    async destroyService(orderUsing) {
      if (confirm(`Bạn đang sử dụng gói ${orderUsing.title}. Bạn chắc chắn muốn ngừng sử dụng gói này ?`)) {
        await this.$store.dispatch('packgesClient/stopPackage', {
          id: orderUsing.id,
          service_id: orderUsing.service_id,
          status: 'unactive',
        })
        await this.getData()
        await this.$store.dispatch('packages/getPackageList', PAYLOAD)
      }
      return
    },

    async cancelOrder(id) {
      if (confirm('Bạn chắc chắn muốn hủy đơn hàng này ?')) {
        await this.$store.dispatch('packages/remove', id)
        await this.getData()
        await this.$store.dispatch('packages/getPackageList', PAYLOAD)
      }
      return
    },

    selectStatus(e) {
      this.selectStatusOrder = e.target.value
    },

    async getExpiredDay(orderUsing) {
      if (
        Object.keys(this.orderUsing).length != 0 &&
        this.userCookie.roles != 'admin'
      ) {
        this.remainingUsageTime = await this.$store.dispatch(
          'packgesClient/getExpire',
          {
            orderUsing: orderUsing,
          }
        )
      }
    },

    isShowAboutToExpire(serviceId) {
      if (
        this.remainingUsageTime <= 5 &&
        this.orderUsing.service_id == serviceId
      ) {
        return true
      } else {
        return false
      }
    },

    async autoStop(orderUsing) {
      if (this.remainingUsageTime <= 0 && this.remainingUsageTime != null) {
        await this.$store.dispatch('packages/stopPackage', {
          id: orderUsing.id,
          service_id: orderUsing.service_id,
          status: 'unactive',
        })
        location.reload()
      }
    },

    async getData() {
      const payload = {
        text: this.valueSearch,
        status: this.selectStatusOrder,
        page: this.currentPage,
        userId: this.userCookie.id,
      }
      if(this.userCookie.roles == "admin"){
        (await this.$store.dispatch('packages/getPackageList', payload)) || []
      } else {
        (await this.$store.dispatch('packgesClient/getPackageList', payload)) || []
      }
    },

    handlePaginate: function (paged) {
      this.currentPage = paged
      this.getData()
    },

    async searchByAdmin() {
      if (this.valueSearch && this.valueSearch != this.oldValueSearch) {
        await this.getData()
        this.oldValueSearch = this.valueSearch
      }
      if (this.oldValueSearch && this.valueSearch == '') {
        await this.getData()
        this.oldValueSearch = ''
      }
      return
    },
  },
}
</script>

<style lang="scss" scoped>
.my-3 {
  font-size: 1.2rem;
}
.alert-warning {
  padding: 5px;
  font-weight: 700;
}

//responsive
//mobile
@media screen and (max-width: 767px) {
  .search-box {
    width: 100%;
    display: unset !important;
    select,
    input,
    button {
      margin-left: 0 !important;
    }
  }
}
</style>
