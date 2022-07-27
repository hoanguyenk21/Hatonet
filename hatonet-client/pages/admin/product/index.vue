<template>
  <section>
    <div class="row mb-3">
      <div class="col-12">
        <btn-create label="Tin tuyển dụng" url="/admin/product/add" />
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <MyTabs>
            <MyTab name="Việc làm công ty">
              <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  <div class="text-muted">
                    Hiển thị
                    <div class="mx-2 d-inline-block">
                      <select class="form-control formselect" v-model="SearchNumber">
                        <option v-for="status in number" :key="status.id" :value="status.id" :selected="status.id"
                          aria-label="Invoices count" id="SearchNumber">
                          {{ status.label }}
                        </option>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchNumber')"></span>
                    mục
                  </div>
                  <div class="ms-auto text-muted">
                  </div>
                  <div v-if="productSelected" class="ms-auto text-muted">
                    Thay đổi :
                    <div class="mx-2 d-inline-block">
                      <select class="form-control formselect" @change="eventChangeStatus($event)">
                        <option value="" selected disabled hidden>Trạng thái</option>
                        <option v-for="status in statuses" :key="status.id" :value="status.value">
                          {{ status.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div v-if="!productSelected" class="ms-auto text-muted">
                    Lọc nhanh:
                    <div class="ms-2 d-inline-block">
                      <select class="form-control" v-model="SearchTerm">
                        <template v-for="skill in options.skill">
                          <option value="" selected disabled hidden>Kỹ năng</option>
                          <option :key="skill" :value="skill.value">
                            {{ skill.name }}
                          </option>
                        </template>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchTerm')"></span>
                    <div class="mx-2 d-inline-block">
                      <select v-model="SearchStatus" class="form-control">
                        <template v-for="status in options.status">
                          <option value="" selected disabled hidden>Trạng thái</option>
                          <option :key="status" :value="status.value">
                            {{ status.name }}
                          </option>
                        </template>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchStatus')"></span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th class="w-1">
                        <input class="form-check-input m-0 align-middle" id="select-all-product"
                          @change="selectedAllProduct($event)" type="checkbox" aria-label="Select all invoices" />
                      </th>
                      <th class="w-50">
                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                      </th>
                      <th>Địa chỉ</th>
                      <th>Thời gian</th>
                      <th>Mức lương</th>
                      <th>Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <DraggAble handle=".grab-move" ghost-class="ghost" tag="tbody">
                    <tr v-for="product in productes.data" :key="productes.id" v-if="product.user_id == getuser.id">
                      <td :class="{ 'active-new': product.status == 'active' }">
                        <input class="form-check-input m-0 align-middle checkbox-product"
                          @change="checkProductSelected($event, product.id)" :value="product.id" type="checkbox"
                          aria-label="Select invoice" />
                      </td>
                      <td>
                        <div class="d-flex py-1 align-items-center" v-if="product.user">
                          <SectionImage class="avatar avatar-md me-3 bg-dark" :src="baseUrl + product.user.avatar" />
                          <div class="flex-fill">
                            <div v-if="getuser.roles == 'admin' && product.status == 'pending'">
                              <nuxt-link :to="{ path: '/admin/product/edit', query: { id: product.id } }"
                                class="font-weight-medium title">
                                {{ product.title }}
                              </nuxt-link>
                            </div>
                            <div v-else>
                              <div v-if="product.user.id == getuser.id && product.status == 'pending'">
                                <nuxt-link :to="{ path: '/admin/product/edit', query: { id: product.id } }"
                                  class="font-weight-medium title">
                                  {{ product.title }}
                                </nuxt-link>
                              </div>
                              <div v-else>
                                <nuxt-link :to="{ path: '/admin/product/show', query: { id: product.id } }"
                                  class="font-weight-medium title">
                                  {{ product.title }}
                                </nuxt-link>
                              </div>
                            </div>
                            <ul class="tags">
                              <li>
                                <div v-for=" proMe in product.product_meta" :key="proMe.id">
                                  <div v-if="proMe.meta_key == '_skill'">
                                    <div v-for="skill in options.skill">
                                      <span v-if="proMe.meta_value == skill.id">
                                        {{ skill.name }}
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div v-for=" proMe in product.product_meta" :key="proMe.id">
                          <div v-if="proMe.meta_key == '_address'">
                            <div v-for="location in options.location">
                              <span v-if="proMe.meta_value == location.id">
                                {{ location.name }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span>
                          {{ product.created_at }}
                        </span>
                      </td>
                      <td>
                        <strong>{{ new Intl.NumberFormat().format(product.price_sale) }}đ</strong>
                      </td>
                      <td><span class="badge bg-warning me-1"></span> {{ product.status }}</td>
                      <td class="text-end">
                        <span class="dropdown">
                          <button class="btn btn-pdf" @click="downloadFile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                              <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                              <path
                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                            </svg>
                            <span>Tải PDF</span>
                          </button>
                        </span>
                      </td>
                      <td class="text-end grab-move">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-arrows-expand" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8zM7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10z" />
                        </svg>
                      </td>
                    </tr>
                  </DraggAble>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <paginate :total="productes.total" @paginate="paginate" />
              </div>
            </MyTab>
            <MyTab name="Việc làm khác">
              <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  <div class="text-muted">
                    Hiển thị
                    <div class="mx-2 d-inline-block">
                      <select class="form-control formselect" v-model="SearchNumber">
                        <option v-for="status in number" :key="status.id" :value="status.id" :selected="status.id"
                          aria-label="Invoices count" id="SearchNumber">
                          {{ status.label }}
                        </option>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchNumber')"></span>
                    mục
                  </div>
                  <div class="ms-auto text-muted">
                  </div>
                  <div v-if="productSelected" class="ms-auto text-muted">
                    Thay đổi :
                    <div class="mx-2 d-inline-block">
                      <select class="form-control formselect" @change="eventChangeStatus($event)">
                        <option value="" selected disabled hidden>Trạng thái</option>
                        <option v-for="status in statuses" :key="status.id" :value="status.value">
                          {{ status.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div v-if="!productSelected" class="ms-auto text-muted">
                    Lọc nhanh:
                    <div class="ms-2 d-inline-block">
                      <select class="form-control" v-model="SearchTerm">
                        <template v-for="skill in options.skill">
                          <option value="" selected disabled hidden>Kỹ năng</option>
                          <option :key="skill" :value="skill.value">
                            {{ skill.name }}
                          </option>
                        </template>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchTerm')"></span>
                    <div class="mx-2 d-inline-block">
                      <select v-model="SearchStatus" class="form-control">
                        <template v-for="status in options.status">
                          <option value="" selected disabled hidden>Trạng thái</option>
                          <option :key="status" :value="status.value">
                            {{ status.name }}
                          </option>
                        </template>
                      </select>
                    </div>
                    <span class="ti ti-x icons" @click="click('SearchStatus')"></span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th class="w-1">
                        <input class="form-check-input m-0 align-middle" id="select-all-product"
                          @change="selectedAllProduct($event)" type="checkbox" aria-label="Select all invoices" />
                      </th>
                      <th class="w-50">
                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                      </th>
                      <th>Địa chỉ</th>
                      <th>Thời gian</th>
                      <th>Mức lương</th>
                      <th>Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <DraggAble handle=".grab-move" ghost-class="ghost" tag="tbody">
                    <tr v-for="product in productes.data" :key="productes.id" v-if="product.user_id != getuser.id">
                      <td :class="{ 'active-new': product.status == 'active' }">
                        <input class="form-check-input m-0 align-middle checkbox-product"
                          @change="checkProductSelected($event, product.id)" :value="product.id" type="checkbox"
                          aria-label="Select invoice" />
                      </td>
                      <td>
                        <div class="d-flex py-1 align-items-center" v-if="product.user">
                          <SectionImage class="avatar avatar-md me-3 bg-dark" :src="baseUrl + product.user.avatar" />
                          <div class="flex-fill">
                            <div v-if="getuser.roles == 'admin' && product.status == 'pending'">
                              <nuxt-link :to="{ path: '/admin/product/edit', query: { id: product.id } }"
                                class="font-weight-medium title">
                                {{ product.title }}
                              </nuxt-link>
                            </div>
                            <div v-else>
                              <div v-if="product.user.id == getuser.id && product.status == 'pending'">
                                <nuxt-link :to="{ path: '/admin/product/edit', query: { id: product.id } }"
                                  class="font-weight-medium title">
                                  {{ product.title }}
                                </nuxt-link>
                              </div>
                              <div v-else>
                                <nuxt-link :to="{ path: '/admin/product/show', query: { id: product.id } }"
                                  class="font-weight-medium title">
                                  {{ product.title }}
                                </nuxt-link>
                              </div>
                            </div>
                            <ul class="tags">
                              <li>
                                <div v-for=" proMe in product.product_meta" :key="proMe.id">
                                  <div v-if="proMe.meta_key == '_skill'">
                                    <div v-for="skill in options.skill">
                                      <span v-if="proMe.meta_value == skill.id">
                                        {{ skill.name }}
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div v-for=" proMe in product.product_meta" :key="proMe.id">
                          <div v-if="proMe.meta_key == '_address'">
                            <div v-for="location in options.location">
                              <span v-if="proMe.meta_value == location.id">
                                {{ location.name }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span>
                          {{ product.created_at }}
                        </span>
                      </td>
                      <td>
                        <strong>{{ new Intl.NumberFormat().format(product.price_sale) }}đ</strong>
                      </td>
                      <td><span class="badge bg-warning me-1"></span> {{ product.status }}</td>
                      <td class="text-end">
                        <span class="dropdown">
                          <button class="btn btn-pdf" @click="downloadFile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                              <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                              <path
                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                            </svg>
                            <span>Tải PDF</span>
                          </button>
                        </span>
                      </td>
                      <td class="text-end">
                        <span class="dropdown">
                          <button class="btn btn-apply" >
                            <span>Ứng tuyển</span>
                          </button>
                        </span>
                      </td>
                      <td class="text-end grab-move">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-arrows-expand" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8zM7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10z" />
                        </svg>
                      </td>
                    </tr>
                  </DraggAble>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <paginate :total="productes.total" @paginate="paginate" />
              </div>
            </MyTab>
          </MyTabs>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { LOCATION, SKILL, STATUS, } from '@/constants/common'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'
import BtnCreate from '@/components/admin/BtnCreate.vue'
import { mapState } from 'vuex'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../../components/client/SectionImage.vue'
import product from '../../../store/admin/product'
import MyTabs from '../../../components/client/common/MyTabs.vue'
import MyTab from '../../../components/client/common/MyTab.vue'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel, BtnCreate, SectionImage, MyTabs, MyTab },

  data: () => ({
    products: {
      meta: {},
    },
    options: {
      status: STATUS,
      location: LOCATION,
      skill: SKILL
    },

    statuses: [
      {
        id: 123,
        name: 'Active',
        value: 'active',
      },
      {
        id: 124,
        name: 'Deactive',
        value: 'deactive',
      },
    ],

    number: [
      {
        id: '5',
        label: '5',
      },
      {
        id: '10',
        label: '10',
      },
      {
        id: '15',
        label: '15',
      },
      {
        id: '20',
        label: '20',
      },
    ],
    SearchNumber: '',
    SearchStatus: '',
    SearchTerm: '',
    productSelected: false,
    SelectedItems: [],
    baseUrl: baseUrl,
  }),

  computed: {
    ...mapState('product', ['productes']),
    getuser({ $cookies }) {
      return $cookies.get('_user');
    },
  },

  async fetch({ store }) {
    await store.dispatch('product/getProductList', { SearchNumber: null, SearchStatus: null, SearchTerm: null });
  },

  watch: {
    SearchNumber: function () {
      this.NumberData();
    },

    SearchStatus: function () {
      this.NumberStatus();
    },

    SearchTerm: function () {
      this.NumberTerm();
    },

    '$route.query'() {
      this.$fetch()
    },
  },

  // mounted () {
  //   this.downloadFile();
  // },

  methods: {
    async NumberData() {
      await this.$store.dispatch('product/getProductList', { SearchNumber: this.SearchNumber });
    },

    async NumberStatus() {
      await this.$store.dispatch('product/getProductList', { SearchStatus: this.SearchStatus });
    },

    async NumberTerm() {
      await this.$store.dispatch('product/getProductList', { SearchTerm: this.SearchTerm });

    },

    async paginate(page) {
      if (this.SearchNumber) {
        await this.$store.dispatch('product/getProductList', { SearchNumber: this.SearchNumber, page });
      } else if (this.SearchStatus) {
        await this.$store.dispatch('product/getProductList', { SearchStatus: this.SearchStatus, page });
      } else if (this.SearchTerm) {
        await this.$store.dispatch('product/getProductList', { SearchTerm: this.SearchTerm, page });
      } else {
        (await this.$store.dispatch('product/getProductList', { page: page })).data
      }

    },

    async checkProductSelected(event, productID) {
      let checked = event.target.checked;

      if (checked) {
        this.SelectedItems.push(productID);
      } else {
        let itemRemove = productID;
        let array = this.SelectedItems;

        this.SelectedItems = array.filter(function (value) {
          return value != itemRemove;
        });
      }
      (this.SelectedItems.length) ? (this.productSelected = true) : (this.productSelected = false);
    },

    async selectedAllProduct(event) {
      let checked = event.target.checked;

      if (checked) {
        var elems = document.getElementsByClassName("checkbox-product");
        var array = [];
        Array.from(elems).forEach(function (v) {
          v.checked = true;
          array.push(parseInt(v.value));
        });
        this.SelectedItems = array;
      } else {
        var elems = document.getElementsByClassName("checkbox-product");
        Array.from(elems).forEach(function (v) {
          v.checked = false;
        });
        this.SelectedItems = []
      }
      (this.SelectedItems.length) ? (this.productSelected = true) : (this.productSelected = false);
    },

    async eventChangeStatus(event) {
      let status = event.target.value;
      for (const id of this.SelectedItems) {
        let product = this.productes.data.find(product => product.id === id);
        product.change_status = JSON.parse(true);
        product.new_status = status;
        await this.$store.dispatch('product/updateProduct', product);
      }
      await this.$store.dispatch('product/getProductList', { SearchNumber: this.SearchNumber, SearchStatus: this.SearchStatus, SearchTerm: this.SearchTerm });
      this.SelectedItems = [];
      var elems = document.getElementsByClassName("checkbox-product");
      Array.from(elems).forEach(v => v.checked = false);
      document.getElementById("select-all-product").checked = false;
      (this.SelectedItems.length) ? (this.productSelected = true) : (this.productSelected = false);
    },

    downloadFile() {
      this.$store.dispatch('productClient/downloadFile');
    },

    click(model) {
      switch (model) {
        case 'SearchTerm':
          this.SearchTerm = null;
          break;
        case 'SearchNumber':
          this.SearchNumber = null;
          break;
        case 'SearchStatus':
          this.SearchStatus = null;
          break;

        default:
          break;
      }
    }
  }



}
</script>

<style lang="scss" scoped>
.icons {
  position: absolute;
  margin-left: -27px;
  margin-top: 5px;
}

.form-control {
  padding: 2px;
  margin-right: 25px !important;
}

.formselect {
  margin-right: 25px !important;
}

.active-new {
  border-left: 5px solid #4caf50;
}

.btn-create {
  display: flex;
  gap: 5px;
  max-width: 200px;

  svg {
    width: 22px;
    height: 22px;
  }
}

.btn-pdf {
  font-size: 0.8rem;

  svg {
    width: 20px;
    height: 20px;
    margin-right: 0.3em;
  }
}

.btn-apply {
  background: hsla(14deg, 100%, 77%, 0.15);
  border: 1px solid hsla(14deg, 100%, 77%, 0.52);
  font-size: 0.8rem;
  color: #ff5400;
  font-weight: 500;

  svg {
    width: 20px;
    height: 20px;
    margin-right: 0.3em;
  }
}

.card{
  border: none !important;;
}
.meta {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  grid-gap: 20px;
  gap: 20px;
  height: 25px;
  align-items: center;

  li {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9rem;
  }
}

.tags {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  grid-gap: 10px;
  gap: 10px;
  height: 30px;
  align-items: flex-end;

  li {
    background: hsl(14deg 100% 77% / 15%);
    border: 1px solid hsl(14deg 100% 77% / 52%);
    padding: 0 1em;
    border-radius: 35px;
    font-size: 0.8rem;
    color: #ff5400;
    font-weight: 500;
  }
}

.title {
  font-size: 1rem;
  font-weight: 700;
  margin-bottom: 0em;
  color: #1e293b;
  display: block;
  text-decoration: none;

  &:hover {
    text-decoration: none;
    color: #000;
  }
}

tr {
  &:hover {
    background: #fafafa;

    .title {
      color: #000;
    }
  }
}

.ghost {
  background: #f1f1f1;
}
</style>
