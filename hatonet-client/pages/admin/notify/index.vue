<template>
  <section>
    <div class="row" v-if="$cookies.get('_user').id == 1">
      <div class="col-4 col-md-4 col-xl-4">
        <div class="card">
          <div class="card-body">
            <validation-observer v-slot="{ valid, handleSubmit }">
              <div class="mb-3">
                <label class="form-label required">Tiêu đề</label>

                <validation-provider v-slot="{ errors }" rules="required">
                  <input class="form-control" v-model="notifys.title" placeholder="Tiêu đề" />
                  <span class="message">{{ errors[0] }}</span>
                </validation-provider>
              </div>
              <div class="mb-3">
                <label class="form-label">type</label>
                <select class="form-control" placeholder="Hệ thống" v-model="notifys.type">
                  <option id="1" value="Hệ thống" :selected="1">Hệ thống</option>
                  <option value="Quảng cáo">Quảng cáo</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label required">Nội dung</label>
                <validation-provider v-slot="{ errors }" rules="required">
                  <input class="form-control" v-model="notifys.content" placeholder="Nội dung" />
                  <span class="message">{{ errors[0] }}</span>
                </validation-provider>
              </div>
              <div class="mb-3">
                <label class="form-label required">Người nhận </label>
                <select v-model="isSelectAll" class="form-control">
                  <option :value="true">Chọn tất cả</option>
                  <option :value="false">Theo nhóm người nhận</option>
                </select>
                <template v-if="!isSelectAll">
                  <validation-provider v-slot="{ errors }" rules="required">
                    <vue-multiselect v-model="notifys.user_receive" :options="userReceive" track-by="id" label="name"
                      :multiple="true" :taggable="true" placeholder="" /><span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </template>
              </div>
              <div class="mb-3">
                <label class="form-label required" >
                  <span>Chi tiết</span>
                </label>
                <validation-provider v-slot="{ errors }" rules="required">
                  <textarea v-model="notifys.description" :class="[{ 'is-invalid': errors.description }]"
                    class="form-control" name="example-textarea-input" rows="6" placeholder="Chi tiết">
              </textarea><span class="message">{{ errors[0] }}</span>
                </validation-provider>
              </div>
              <div class="mb-3" style="text-align: right; ">
                <button style="background-color: black;" @click="handleSubmit(onSubmit(valid))" class="btn btn-primary">
                  Tạo thông báo
                </button>
              </div>
            </validation-observer>
          </div>
        </div>
      </div>
      <div class="col-8 col-md-8 col-xl-8">
        <div class="card">
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="ms-auto text-muted">
                Tìm kiếm:
                <div class="ms-2 d-inline-block">
                  <input v-model="search" type="text" class="form-control form-control-sm"
                    aria-label="Search invoice" />
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1">
                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" />
                  </th>
                  <th class="w-1">Tiêu đề</th>
                  <th>Chi tiết</th>
                  <th>Nội dung</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody v-for="notify in notifys" :key="notify.id">
                <tr>
                  <td>
                    <i class="fs-3 ti ti-device-mobile-message"></i>
                  </td>
                  <td>{{ notify.title }}</td>
                  <td>{{ notify.description }}</td>
                  <td>{{ notify.content }}</td>
                  <td>
                    <button @click="redirectToEditFormnotify(notify.id)" class="btn btn-primary btn-edit">
                      Sửa
                    </button>
                    <button @click="Remove(notify.id)" class="btn btn-primary btn-delete">
                      Xóa
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <paginate :total="paginate.total" @paginate="paginate" />
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="$cookies.get('_user').id != 1">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="ms-auto text-muted">
                Tìm kiếm:
                <div class="ms-2 d-inline-block">
                  <input v-model="search" type="text" class="form-control form-control-sm"
                    aria-label="Search invoice" />
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1">
                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" />
                  </th>
                  <th class="w-1">Tiêu đề</th>
                  <th>Chi tiết</th>
                  <th>Thao tác</th>
                  <th>Chi tiết</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <div class="dropdown">
              </div>
              <tbody v-for="notify in notifysShow" :key="notify.id">
                <tr :class="notify.actision == 0 ? 'hien' : ''" @click="submitUpdate(notify)">
                  <td>
                    <i class="fs-3 ti ti-device-mobile-message"></i>
                  </td>
                  <td>{{ notify.title }}</td>
                  <td>{{ notify.description }}</td>
                  <td>{{ notify.title }}</td>
                  <td>{{ notify.description }}</td>
                  <td>
                    <a @click="Remove(notify.id)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd"
                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <paginate :total="paginate.total" @paginate="paginate" />
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
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel },
  data: () => ({
    isDropdown: false,
    notifys: {},
    notifysShow: [],
    userReceive: [],
    errors: {},
    isSelectAll: true,
  }),
  components: { Paginate, StatusLabel },
  async fetch() {
    try {
      let resp = await this.$store.dispatch('notify/getNotifyList')
      this.notifys = resp.data
      const user = this.$cookies.get('_user')
      this.user = user
      const userReceive = (await this.$store.dispatch('account/getAccount')).data
      this.userReceive = userReceive.data.filter((item) => item.id != 1)
      this.notifys.map((item) => {
        let userReceive = JSON.parse(item.user_receive)
        if(typeof userReceive=='object'){
        if (userReceive.find((user) => user.id == this.user.id)) {
          this.notifysShow.push(item)
        }
        }
      
      })
    } catch (error) {
      console.error(error)
    }
  },
  methods: {
    async submitUpdate(data) {
      this.isDropdown = !this.isDropdown;
      const resps = await this.$store.dispatch('notify/updateNotifyActison', data)
      const index = this.notifysShow.findIndex((item) => {
        return item.id === data.id;
      });
      this.notifysShow[index].actision = 1;
    },
    async onSubmit(valid) {
      try {
        if (this.isSelectAll) {
          this.notifys.user_receive = this.userReceive
        }
        let userIds = []
        this.notifys.user_receive.forEach((item) => {
          userIds.push({
            id: item.id,
            name: item.name,
          })
        })
        const user = this.$cookies.get('_user')
        this.notifys.user_id = user.id
        const formsData = {
          title: this.notifys.title,
          description: this.notifys.description,
          content: this.notifys.content,
          type: this.notifys.type,
          user_id: this.notifys.user_id,
          user_receive: JSON.stringify(userIds),
        }
        await this.$store.dispatch('notify/createNotify', formsData)
        await this.$store.dispatch('notify/getNotifyList').then((resp) => {
          this.notifys = resp.data
        })
        this.$toast.success('Thêm thông báo thành công !')
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Thêm thông báo không thành công !')
      }
    },
    async Remove($id) {
      if (confirm('Bạn có muốn xóa không ?')) {
        try {
          await this.$store.dispatch('notify/removeNotify', $id)
          await this.$store.dispatch('notify/getNotifyList').then((resp) => {
            this.notifys = resp.data
          }), this.$toast.success('Xóa thông báo thành công !')
        } catch (error) {
          this.$mixError(error)
          this.$toast.error('Xóa thông báo không thành công !')
        }
      }
    },
    redirectToEditFormnotify(id) {
      this.$router.push({ path: 'notify/edit', query: { id: id } })
    },
    paginate: async function (paged) {
      this.$store.dispatch('notify/getNotifyList', paged)
    },
  },
}
</script>
 
<style>
.message {
  color: red;
}

.admin .dropdown-menu.show {
  width: 100%;
}

.admin .modal-backdrop {
  display: none !important;
  height: 100vh;
  background-color: none !important;
}

.btn-edit {
  background-color: black !important;
}

.btn-delete {
  background-color: red !important;
}

.hien {
  background-color: #ccc;
}

/* Nút Dropdown*/
.nut_dropdown {
  background-color: #0080ff;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* Thiết lập vị trí cho thẻ div với class dropdown*/
.dropdown {
  position: relative;
  display: inline-block;
}

/* Nội dung Dropdown */
.noidung_dropdown {
  /*Ẩn nội dụng các đường dẫn*/
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

/* Thiết kế style cho các đường dẫn tronng Dropdown */
.noidung_dropdown a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.show {
  display: block;
}

.hidden {
  display: none;
}
.error{
  background-color:#CC0000 !important ;
}
</style>





