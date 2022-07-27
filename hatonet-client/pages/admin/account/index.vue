<template>
  <div class="row">
    <div class="col-12 mb-3" v-if="userCookie.roles == 'company'">
      <nuxt-link class="btn" :to="{ name: 'admin-account-add' }">
        <i class="ti ti-plus"></i> <span>Tạo tài khoản</span>
      </nuxt-link>
      <nuxt-link
        class="btn"
        :to="{
          path: `/admin/account/edit`,
          query: { id: userCookie.id },
        }"
      >
        Đổi mật khẩu
      </nuxt-link>
    </div>
    <div class="col-12 mb-3" v-if="userCookie.roles == 'member'">
      <nuxt-link
        class="btn"
        :to="{
          path: `/admin/account/edit`,
          query: { id: userCookie.id },
        }"
      >
        Đổi mật khẩu
      </nuxt-link>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-8 align-items-center">
            Search:
            <div class="select-status">
              <select class="form-select" @change="selectStatus">
                <option value="" :selected="valueSelect == ''">
                  Trạng thái
                </option>
                <option
                  v-for="(item, index) in status"
                  :key="index"
                  :value="item"
                >
                  {{ item }}
                </option>
              </select>
            </div>
            <div class="position-relative input-search">
              <input
                type="text"
                class="form-control"
                v-model="valueSearch"
                placeholder="Email hoặc số điện thoại"
              />
              <button
                class="btn btn-search position-absolute"
                @click="searchEmailOrPhone"
              >
                Tìm kiếm
              </button>
              <i class="ti ti-x" v-if="valueSearch" @click="callbackData"></i>
            </div>
          </div>

          <!--  admin area   -->
          <div class="table-responsive mt-3" v-if="userCookie.roles == 'admin'">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <th>ID</th>
                <th>Email</th>
                <th>Tên người dùng</th>
                <td>Số điện thoại</td>
                <th>Khởi tạo</th>
                <th class="w-2">Vai trò</th>
                <th class="w-1">Trạng thái</th>
              </thead>
              <tbody>
                <tr v-for="(account, index) in items.data" :key="account.id">
                  <td>{{ account.id }}</td>
                  <td>{{ account.email }}</td>
                  <td>{{ account.name }}</td>
                  <td>{{ account.phone }}</td>
                  <td>{{ account.created_at }}</td>
                  <td class="text-muted">
                    {{ account.roles }}
                  </td>
                  <td>
                    <status-label :status="account.status" />
                  </td>
                  <td>
                    <nuxt-link
                      class="btn"
                      :to="{
                        path: `/admin/account/show`,
                        query: { id: account.id },
                      }"
                    >
                      <i class="ti ti-alert-circle"></i>
                    </nuxt-link>
                    <nuxt-link
                      class="btn"
                      :to="{
                        path: `/admin/account/edit`,
                        query: { id: account.id },
                      }"
                    >
                      <i class="ti ti-tools"></i>
                    </nuxt-link>
                    <button
                      :class="account.id == userCookie.id ? 'd-none' : ''"
                      class="btn"
                      @click="deleteAcc(account)"
                    >
                      <i class="ti ti-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="card-footer d-flex align-items-center">
              <Paginate
                :total="items.total"
                :perPage="items.per_page"
                :currentPage="currentPage"
                @paginate="handlePaginate"
              />
            </div>
          </div>

          <!--  user area   -->
          <div v-else class="table-responsive mt-3">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <th>ID</th>
                <th>Email</th>
                <th>Tên người dùng</th>
                <td>Số điện thoại</td>
                <th>Khởi tạo</th>
                <th class="w-2">Vai trò</th>
                <th class="w-1">Trạng thái</th>
              </thead>
              <tbody>
                <tr v-for="(account, index) in users.data" :key="account.id">
                  <td>{{ account.id }}</td>
                  <td>{{ account.email }}</td>
                  <td>{{ account.name }}</td>
                  <td>{{ account.phone }}</td>
                  <td>{{ account.created_at }}</td>
                  <td class="text-muted">
                    {{ account.roles }}
                  </td>
                  <td>
                    <status-label :status="account.status" />
                  </td>
                  <td>
                    <nuxt-link
                      class="btn"
                      :to="{
                        path: `/admin/account/show`,
                        query: { id: account.id },
                      }"
                    >
                      <i class="ti ti-alert-circle"></i>
                    </nuxt-link>
                    <nuxt-link
                      class="btn"
                      :to="{
                        path: `/admin/account/edit`,
                        query: { id: account.id },
                      }"
                    >
                      <i class="ti ti-tools"></i>
                    </nuxt-link>
                    <button class="btn" @click="deleteAcc(account)">
                      <i class="ti ti-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="card-footer d-flex align-items-center">
              <Paginate
                :total="users.total"
                :perPage="users.per_page"
                :currentPage="currentPage"
                @paginate="handlePaginate"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'
import BtnCreate from '@/components/admin/BtnCreate.vue'

export default {
  components: { Paginate, StatusLabel, BtnCreate },
  name: 'AdminAreaAccount',
  layout: 'admin.root',
  data() {
    return {
      status: ['active', 'pending', 'expired', 'suspended'],
      valueSelect: '',
      valueSearch: '',
      oldValueSearch: '',
      userCookie: {},
      currentPage: 1,
    }
  },
  computed: {
    ...mapState('account', ['items', 'users']),
  },
  created() {
    this.userCookie = this.$cookies.get('_user')
    this.getData()
  },

  watch: {
    valueSelect() {
      this.getData()
    },
  },

  methods: {
    async callbackData() {
      this.valueSearch = ''
      this.valueSelect = ''
      this.oldValueSearch = ''
      await this.getData()
    },

    async searchEmailOrPhone() {
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

    selectStatus(e) {
      this.valueSelect = e.target.value
    },

    handlePaginate: function (PAGE) {
      this.currentPage = PAGE
      this.getData()
    },

    async getData() {
      const payload = {
        text: this.valueSearch,
        status: this.valueSelect,
        page: this.currentPage,
        id: this.userCookie.id,
      }
      if (this.userCookie.roles == 'admin') {
        ;(await this.$store.dispatch('account/getAll', payload)) || []
      } else {
        ;(await this.$store.dispatch('account/getUsers', payload)) || []
      }
    },

    async deleteAcc(data) {
      if (confirm(`Bạn chắc chắn muốn xóa tài khoản ${data.name} ?`)) {
        await this.$store.dispatch('account/removeAccount', data.id)
        await this.getData()
        this.$toast.success('Xóa thành công !')
      }
      return
    },
  },
}
</script>

<style scoped lang="scss">
.input-search {
  i {
    position: absolute;
    right: 25%;
    bottom: 50%;
    transform: translateY(50%);
    font-size: 20px;
    color: lightgray;
    cursor: pointer;
  }
}
td {
  padding-left: 0 !important;
}
.float-right {
  float: right;
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
.btn-search {
  right: 0;
  bottom: 50%;
  transform: translateY(50%);
  background: #f60;
  border: 0;
  color: #fff;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
// responsive
//mobile
@media screen and (max-width: 767px) {
  input[type='text'] {
    margin-top: 10px;
  }
}
//tablet
@media screen and (min-width: 768px) {
  .select-status {
    margin-left: 10px;
    margin-right: 20px;
  }
  .align-items-center {
    display: flex;
    input {
      min-width: 380px;
      padding-right: 120px;
    }
    .form-select {
      width: auto !important;
    }
  }
}
</style>
