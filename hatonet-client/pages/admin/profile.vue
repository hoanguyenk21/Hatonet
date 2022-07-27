<template>
  <main>
    <div class="row mb-3">
      <div class="col-12">
        <div class="card card-md">
          <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-orange">
              <i class="ti ti-building-skyscraper"></i>
            </div>
          </div>
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-10">
                <div class="title-company">
                  <h3>{{ user.user.name  }} <sup>Basic</sup></h3>
                  <div class="confirm-company">
                    <svg
                      data-v-7bda3609=""
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      viewBox="0 0 16 16"
                      class="bi bi-patch-check-fill"
                    >
                      <path
                        data-v-7bda3609=""
                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"
                      ></path>
                    </svg>
                    <span>Đã xác thực </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"  role="tab">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-building"
                  viewBox="0 0 16 16"
                >
                  <path
                    fill-rule="evenodd"
                    d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"
                  />
                  <path
                    d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"
                  />
                </svg>
                <span>Thông tin</span>
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pay-tab-pane" role="tab">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-credit-card"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"
                  />
                  <path
                    d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"
                  />
                </svg>
                <span>Thanh toán</span>
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#points-tab-pane" role="tab">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-currency-bitcoin"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25L5.5 13zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28V4.487zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927V8.539z"
                  />
                </svg>
                <span>Điểm tích lũy</span>
              </button>
            </li>
          </ul>
          <div class="card-body"> 
             <div class="tab-content">
              <div id="profile-tab-pane" class="tab-pane fade show active" role="tabpanel" tabindex="0">
                <div class="row">
                  <div class="col-md-6 col-lg-4">
                    <div class="row row-cards">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body p-2 py-4 text-center">
                            <div>
                              <SectionImage   class="avatar avatar-xl avatar-rounded" :src="baseUrl + user.user.avatar"  />
                            </div>
                            <h3 class="mb-0">{{ user.user.name }}</h3>
                            <small class="mb-2 text-muted"
                              >Ngày hoạt động {{ user.user.created_at }}</small
                            >
                            <p class="mb-3">
                              <span class="badge bg-red-lt mt-2"
                                >Chưa xác thực</span
                              >
                            </p>
                            <div>
                              <div class="avatar-list avatar-list-stacked">
                                <span class="avatar avatar-sm avatar-rounded">
                                  <img
                                    :src="
                                      require('@/assets/images/avatar/avatar_0.png')
                                    "
                                  />
                                </span>
                                <span class="avatar avatar-sm avatar-rounded">
                                  <img
                                    :src="
                                      require('@/assets/images/avatar/avatar_1.png')
                                    "
                                /></span>
                                <span class="avatar avatar-sm avatar-rounded">
                                  <img
                                    :src="
                                      require('@/assets/images/avatar/avatar_2.png')
                                    "
                                /></span>
                                <span class="avatar avatar-sm avatar-rounded"
                                  >JL</span
                                >
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">OTP xác thực</label>
                            <input
                              type="text"
                              class="form-control"
                              name="example-text-input"
                              placeholder="xxxx"
                            />
                          </div>
                          <div class="btn-request">
                            <button class="btn-post" @click="addProfiles">
                              Cập nhật
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-8">
                    <div class="mb-3">
                      <label class="form-label">Tên công ty</label>
                      <input
                        type="text"
                        class="form-control"
                        name="example-text-input"
                        placeholder="Tên công ty"
                        v-model="user.user.name"
                      />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Tên viết tắt</label>
                      <input
                        type="text"
                        class="form-control"
                        name="example-disabled-input"
                        placeholder="Tên viết tắt"
                        v-model="user.user.short_name"
                      />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input
                        type="text"
                        class="form-control"
                        name="example-text-input"
                        placeholder="Email công ty"
                        v-model="user.user.email"
                      />
                    </div>
                    <div class="mb-3">
                      <label class="form-label required">Vai trò</label>
                      <input
                        type="text"
                        class="form-control"
                        name="example-required-input"
                        placeholder="Vai trò"
                        v-model="user.user.roles"
                        disabled
                      />
                    </div>
                    <div class="mb-3">
                      <label class="form-label required">Số điện thoại</label>
                      <input
                        type="text"
                        class="form-control"
                        name="example-required-input"
                        placeholder="Số điện thoại"
                        v-model="user.user.phone" 
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Skill</label>
                      <select multiple="multiple" class="form-select" v-model="user.meta._skill">
                        <option v-for="skill in options.skill" :key="skill" :value="skill.id">
                          {{ skill.name }}
                        </option>
                      </select>
                    </div>
                     <div class="form-group mb-3">
                      <label class="form-label">Tỉnh / thành phố</label>
                      <select class="form-select" v-model="user.meta._address">
                          <option v-for="location in options.location" :key="location" :value="location.id">
                            {{ location.name }}
                          </option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Image</label>
                      <input
                        type="file"
                        class="form-control"
                        name="image"
                        id="image"
                        @change="uploadImage($event)"
                      />
                    </div>
                      <div class="mb-3">
                      <label class="form-label">Banner</label>
                      <input
                        type="file"
                        class="form-control"
                        name="banner"
                        id="banner"
                        @change="uploadBanner($event)"
                      />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Mô tả</label>
                      <textarea
                        class="form-control"
                        name="example-textarea-input"
                        rows="3"
                        placeholder="Mô tả"
                        v-model="user.user.description"
                      />
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Input with help icon</label>
                      <div class="row g-2">
                        <div class="col">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Search for…"
                          />
                        </div>
                        <div class="col-auto align-self-center">
                          <span
                            class="form-help"
                            data-bs-toggle="popover"
                            data-bs-placement="top"
                            data-bs-content="<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>
                                  <p class='mb-0'><a href='#'>USP ZIP codes lookup tools</a></p>
                                  "
                            data-bs-html="true"
                            data-bs-original-title=""
                            title=""
                            >?</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="pay-tab-pane" class="tab-pane fade" role="tabpanel" tabindex="0">
                <div>
                  Fringilla egestas nunc quis tellus diam rhoncus ultricies
                  tristique enim at diam, sem nunc amet, pellentesque id egestas
                  velit sed
                </div>
              </div>
              <div id="points-tab-pane" class="tab-pane fade" role="tabpanel" tabindex="0">
                <div>
                  Donec ac vitae diam amet vel leo egestas consequat rhoncus in
                  luctus amet, facilisi sit mauris accumsan nibh habitant
                  senectus
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import {mapState} from 'vuex'
import { LOCATION, SKILL } from '@/constants/common'
import {baseUrl} from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  name: 'ProfileArea',
  layout: 'admin.root',
  // middleware: ["auth"],
    components: {SectionImage},
  computed: {
      ...mapState('user', ['user']),
  },
  data() {
    return {

      user_id: '',
      options: {
        location: LOCATION,
        skill: SKILL,
      },
      name: '',
      baseUrl: baseUrl,
    }
  },
  async fetch({store,$cookies}) {
    const user_id = $cookies.get('_user')
    this.user_id = user_id.id
    if (this.user_id) {
      let user = await store.dispatch('user/getUser', this.user_id)
      this.user = user.data.user
      this.user.meta = user.data.meta
    }
  },
  methods: {
    async addProfiles() {
      try {
        this.user.meta = JSON.stringify(this.user.meta)
        let formData = new FormData()
         formData.append('name' , this.user.user.name);
          formData.append('short_name' , this.user.user.short_name);
         formData.append('email' , this.user.user.email);
         formData.append('phone' , this.user.user.phone);
         formData.append('description' , this.user.user.description);
         formData.append('image' , this.user.user.new_avatar);
         formData.append('banner' , this.user.user.new_banner);
        for (const [key, value] of Object.entries(this.user)) {
          formData.append(`${key}`, value)
        }
        const config = {
          headers: {
            'content-type': 'multipart/form-data',
          },
          root: true,
        }
        await this.$store.dispatch('user/updateUser', {id:this.$cookies.get('_user').id , data:formData} )
        this.user.meta = JSON.parse(this.user.meta)
        this.$toast.success('Cập nhật thành công !')
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Cập nhật thất bại !')
      }
    },
    uploadImage(e) {
      this.user.user.new_avatar = e.target.files[0]
    },
    uploadBanner(e) {
      this.user.user.new_banner = e.target.files[0]
    },
  },
}
</script>

<style lang="scss" scoped>
//
.title-company {
  margin-bottom: 1em;
  h3 {
    font-weight: 800;
    margin: 0;
    font-size: 1.5rem;
    line-height: 1em;
    display: block;
  }
  sup {
    background: #f60;
    font-weight: normal;
    font-size: 0.8rem;
    color: #fff;
    border-radius: 38px;
    height: 38px;
    line-height: 38px;
    padding: 0 1em;
  }
}
.confirm-company {
  margin-bottom: 0.5em;
  display: flex;
  align-items: center;
  gap: 5px;
  svg {
    width: 20px;
    height: 20px;
    fill: #4caf50;
  }
}
.btn-post {
  padding: 0.4em 3em;
  border: 2px solid #ff6116;
  background: #ff6116;
  color: #fff;
  border-radius: 20px;
}
.btn-request {
  text-align: center;
}
</style>