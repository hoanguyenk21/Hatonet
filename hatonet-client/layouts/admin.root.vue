<template>
  <div class="theme-light">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <div class="navbar-brand navbar-brand-autodark">
          <nuxt-link to="/admin">
            <img :src="require('@/assets/images/hatonet_light.svg')" width="110" height="32" alt="Tabler"
              class="navbar-brand-image" />
          </nuxt-link>
        </div>
        <div class="hato-control">
          <nuxt-link to="/">
            <i class="ti ti-home-2"></i>
          </nuxt-link>
          <nuxt-link to="/admin/profile">
            <i class="ti ti-user-circle"></i>
          </nuxt-link>
          <nuxt-link to="/admin/setting/option">
            <i class="ti ti-adjustments"></i>
          </nuxt-link>
          <button @click="handleLogout">
            <i class="ti ti-logout"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="navbar-nav pt-lg-3">
            <li class="nav-item" v-for="(route, i) in routes" :key="i">
              <nuxt-link class="nav-link d-flex align-items-center" :to="route.slug">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <i class="ti fs-2" :class="route.icon"></i>
                </span>

                <span class="nav-link-title"> {{ route.name }}</span>
              </nuxt-link>
            </li>
          </ul>
        </div>
      </div>
    </aside>
    <div class="page-wrapper">
      <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none my-2 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="pre-header">
                <div class="page-pretitle">NHANH CHÓNG - HIỆU QUẢ</div>
                <h5>NỀN TẢNG TUYỂN DỤNG ONSITE HÀNG ĐẦU</h5>
              </div>
            </div>
            <!-- Page title actions -->
            <div class="col">
              <div class="navbar-nav flex-row justify-content-end">
                <div class="d-none d-md-flex">
                  <div class="nav-item dropdown d-md-flex me-3">
                    <a class="nav-link px-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="ti ti-bell fs-1"></i>
                      <span class="badge bg-red"></span>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="table-responsive">
                              <table class=" table card-table table-vcenter text-nowrap datatable ">
                                <thead>
                                  <tr>
                                    <th class="w-1">
                                      <input class="
                                          form-check-input
                                          m-0
                                          align-middle
                                        " type="checkbox" aria-label="Select all invoices" />
                                    </th>
                                    <th class="w-1">Tiêu đề</th>
                                    <th>Chi tiết</th>
                                    <th>Hành động</th>
                                  </tr>
                                </thead>
                                <tbody v-for="notify in notifysShow" :key="notify.id">
                                  <tr v-if="notify.actision == 0" class="hien" @click="submitUpdate1(notify)">
                                    <td>
                                      <i class="fs-3 ti ti-device-mobile-message"></i>
                                    </td>
                                    <td>
                                      {{ notify.title }}
                                    </td>
                                    <td>
                                      {{ notify.description }}
                                    </td>
                                    <td>
                                      <a @click="Remove(notify.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                          fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                          <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                          <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                      </a>
                                    </td>
                                  </tr>

                                  <tr v-if="notify.actision == 1" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <td>
                                      <i class="fs-3 ti ti-device-mobile-message"></i>
                                    </td>
                                    <td>
                                      {{ notify.title }}
                                    </td>
                                    <td>
                                      {{ notify.description }}
                                    </td>
                                    <td>
                                      <a @click="Remove(notify.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                          fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                          <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                          <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                      </a>
                                    </td>
                                  </tr>
                                  <a class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a class="" href="#">{{ notify.title }}</a>
                                  </a>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="nav-item dropdown">
                    <button class="hato-avatar nav-link d-flex p-0">
                      <div class="hato-avatar__text d-none d-xl-block ps-2">
                        <strong>{{ auth.name }}</strong>
                        <div class="small text-muted">{{ auth.roles }}</div>
                      </div>
                      <SectionImage class="avatar avatar-sm bg-orange" :src="baseUrl + auth.avatar" />
                    </button>
                    <div class="dropdown-menu">
                      <a href="#" class="dropdown-item">Set status</a>
                      <a href="#" class="dropdown-item">Profile &amp; account</a>
                      <a href="#" class="dropdown-item">Feedback</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">Settings</a>
                      <a href="#" class="dropdown-item">Logout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="page-body">
        <div class="container-xl" id="1">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import routes from '@/routes/routes.panel.js'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../components/client/SectionImage.vue'
export default {
  name: 'admin.root',
  middleware: ['auth'],
  head() {
    return {
      title: 'Khách hàng',
      bodyAttrs: {
        class: 'admin',
      },
    }
  },
  components: { SectionImage },
  data: () => ({
    routes: routes.admin,
    auth: {},
    isLogin: false,
    notifysShow: [],
    notifys: {
      title: '',
      user_id: '',
      content: '',
      description: '',
      user_receive: '',
      type: '',
      actision: '',
    },
    baseUrl: baseUrl,
  }),

  async created() {
    let resp = await this.$axios.get('/api/admin/notifies')
    this.notifys = resp.data
    const user = await this.$cookies.get('_user')
    this.auth = user
    this.user = user
    this.notifys.map((item) => {
      let userReceive = JSON.parse(item.user_receive)
      if (userReceive.find((user) => user.id == this.user.id)) {
        this.notifysShow.push(item)
      }
    })
    // set login
    if (user.id) this.isLogin = true
    // set role
    if (user.roles == 'admin') {
      this.routes = routes.admin
    } else {
      this.routes = routes.company
    }
  },

  methods: {
    async submitUpdate1(data) {
      const resps = await this.$axios.put(
        `/api/admin/notifies/status/${data.id}`,
        data
      )
      await this.$axios.get('/api/admin/notifies').then((resp) => {
        this.notify = resp.data
      })
    },
    async Remove($id) {
      if (confirm('Bạn có muốn xóa không ?')) {
        await this.$store.dispatch('notify/removeNotify', $id)
        await this.$store.dispatch('notify/getNotifyList').then((resp) => {
          this.notify = resp.data
        })
        window.location.reload()
      }
    },
    handleLogout: async function () {
      this.$store.dispatch('logout')
    },
  },
}
</script>


<style scoped lang="scss">
.hato-avatar {
  gap: 10px;
  display: flex;
  line-height: 1rem;
  border: none;
  border-radius: 5px;
  background: transparent;

  &__text {
    text-align: right;
  }
}

.hato-control {
  background: #ffffff08;
  padding: 0;
  border-radius: 35px;
  margin-top: 1em;
  display: flex;
  height: 30px;
  line-height: 30px;

  button,
  a {
    outline: none;
    text-decoration: none;
    background: transparent;
    flex: 1;
    text-decoration: none;
    text-align: center;
    color: #fff;
    align-items: center;
    display: flex;
    justify-content: center;
    border: none;

    i {
      font-size: 1.2rem;
    }

    &:focus {
      outline: none;
      border: none;
    }

    &:hover {
      text-decoration: none;
    }
  }
}

.navbar-nav {
  .active {
    background: rgb(255 255 255 / 15%);
    border-radius: 30px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    width: 90%;
    color: #fff !important;
  }
}

.nav-group a {
  border: none;
}

.nav-group button {
  border: none;
}

.pre-header {
  h5 {
    font-size: 1.1rem;
    margin-bottom: 0;
    font-weight: bold;
    margin-top: 0.2rem;
  }
}

.modal-content {
  box-shadow: 1px 1px 1px #aaa;
  max-width: 392px !important;
}

.modal-body {
  background-color: #fff;
}

.admin .modal-backdrop {
  display: none !important;
  height: 100vh;
  background-color: none !important;
}

.admin .modal {
  top: 25px !important;
  left: 471px !important;
}
</style>
