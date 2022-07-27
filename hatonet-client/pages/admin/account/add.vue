<template>
  <section>
    <div class="row">

      <div class="col-12 align-items-center mb-3">
        <button class="btn btn-dark btn-create" @click="createAcc">
          <i class="ti ti-plus"></i> <span>Thêm mới</span>
        </button>
        <nuxt-link class="btn btn-dark btn-create" to="/admin/account">Quay lại</nuxt-link>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body p-2">
            <div class="mb-3">
              <label class="form-label">Tên tài khoản <span>*</span></label>
              <input v-model="items.name" type="text" class="form-control" :class="[{ 'is-invalid': errors.name }]" />
              <span class="text-danger alertSpan" v-if="errors && errors.name">
                {{ errors.name[0] }}
              </span>
            </div>
              <div class="mb-3">
              <label class="form-label">Tên viết tắt<span>*</span></label>
              <input v-model="items.short_name" type="text" class="form-control" />
              <div class="alert alert-danger" v-if="errors && errors.short_name">
                {{ errors.short_name[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Số điện thoại <span>*</span></label>
              <input v-model="items.phone" type="number" class="form-control"
                :class="[{ 'is-invalid': errors.phone }]" />
              <span class="text-danger alertSpan" v-if="errors && errors.phone">
                {{ errors.phone[0] }}
              </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email <span>*</span></label>
              <input v-model="items.email" type="email" class="form-control"
                :class="[{ 'is-invalid': errors.email }]" />
              <span class="text-danger alertSpan" v-if="errors && errors.email">
                {{ errors.email[0] }}
              </span>
            </div>

            <div class="mb-3">
              <label class="form-label">Mật khẩu <span>*</span></label>
              <input v-model="items.password" type="password" class="form-control"
                :class="[{ 'is-invalid': errors.password }]" />
              <span class="text-danger alertSpan" v-if="errors && errors.password">
                {{ errors.password[0] }}
              </span>
            </div>
            <input v-model="items.roles" type="hidden" class="form-control"
                 />

          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script>
import { LOCATION, SKILL } from '@/constants/common'

export default {
  name: 'AdminAreaAccount',
  layout: 'admin.root',
  data() {
    return {
      items: {
      roles:'member'
      },
      url: null,
      errors: {},
    }
  },

  computed: {},

  created() {
    try {
      this.items.parent_id = this.$cookies.get('_user').id || null
    } catch (error) {
      this.errors = this.$mixError(error)
    }
  },

  methods: {
    async createAcc() {
      try {
        this.items.parent_id = this.$cookies.get('_user').id;
        await this.$store.dispatch('account/createAccount', this.items)
        await this.$router.push({ path: '/admin/account' })
        await this.$toast.success('Tạo tài khoản thành công !')
      } catch (error) {
this.errors = this.$mixError(error)
      }
    },

    // uploadImage(e) {
    //   this.items.avatar = e.target.files[0]
    //   this.url = URL.createObjectURL(this.items.avatar)
    // },

    // deleteImage() {
    //   ;(this.url = null), (this.$refs.file.value = '')
    // },
  },
}
</script>

<style lang="scss" scoped>
.preview {
  width: 120px;

  img {
    max-width: 100%;
  }

  button {
    border: 0;
    background: transparent;

    i {
      font-size: 20px;
      font-weight: bold;
      color: lightgrey;
    }
  }
}

label span {
  color: crimson;
}

.alert {
  box-shadow: none !important;
  color: #fb5858;
}

.alert-danger {
  padding: 0;
  border: 0;
  margin-top: 5px;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type='number'] {
  -moz-appearance: textfield;
}
</style>
