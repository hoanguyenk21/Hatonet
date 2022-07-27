<template>
  <section>
    <div class="row">
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Tên gói</label>
              <input
                type="text"
                class="form-control"
                placeholder="Tên gói ...."
                v-model="itemService.title"
              />
              <div class="alert alert-danger" v-if="errors && errors.title">
                {{ errors.title[0] }}
              </div>
            </div>

            <div>
              <label class="form-check">
                <input class="form-check-input" type="checkbox" checked="" />
                <span class="form-check-label">Gói khuyên dùng</span>
              </label>
            </div>

            <div class="mb-3">
              <label class="form-label">Mô tả</label>
              <input
                type="text"
                class="form-control"
                placeholder="Mô tả ...."
                v-model="itemService.description"
              />
              <div
                class="alert alert-danger"
                v-if="errors && errors.description"
              >
                {{ errors.description[0] }}
              </div>
            </div>

            <div class=" position-relative">
              <label class="form-label">Ngày bắt đầu</label>
              <flat-pickr v-model="itemService.service_start"
                :config="{ dateFormat: 'd-m-Y' }"
              />
              <i class="ti ti-calendar position-absolute"></i>
            </div>
            <div
              class="alert alert-danger mb-3"
              v-if="errors && errors.service_start"
            >
              {{ errors.service_start[0] }}
            </div>

            <div class="position-relative">
              <label class="form-label">Ngày kết thúc</label>
              <flat-pickr v-model="itemService.service_end" :config="{ dateFormat: 'd-m-Y' }" />
              <i class="ti ti-calendar position-absolute"></i>
            </div>
            <div
              class="alert alert-danger mb-3"
              v-if="errors && errors.service_end"
            >
              {{ errors.service_end[0] }}
            </div>

            <div class="mb-3">
              <label class="form-label">Trạng thái</label>
              <select v-model="itemService.status" class="form-select">
                <option
                  v-for="(value, index) in status"
                  :key="index"
                  :value="value"
                >
                  {{ value }}
                </option>
              </select>
              <div class="alert alert-danger" v-if="errors && errors.status">
                {{ errors.status[0] }}
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div
              class="row align-items-center mb-3 bg-light text-dark rounded-2 py-2"
            >
              <div class="col-xl-1 col-2">
                <button class="btn" @click="pushAttribute">
                  <i class="ti fs-2 ti-circle-plus"></i>
                </button>
              </div>

              <div class="col-md-3 col-xl-2 col-4 px-3">
                <label class="form-check mb-0">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="attribute.support"
                    checked
                  />
                  <span class="form-check-label">Hỗ trợ</span>
                </label>
              </div>
              <div class="col-md-7 col-xl-9 col-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="attribute.name"
                  placeholder="Nội dung hỗ trợ ."
                />
              </div>
            </div>

            <section v-for="(meta, index) in itemService.service_meta" :key="index">
              <div class="row align-items-center mb-1">
                <div class="col-xl-1 col-2">
                  <button class="btn" @click="remoteAttribute(index)">
                    <i class="ti ti-trash"></i>
                  </button>
                </div>
                <div class="col-md-3 col-xl-2 col-4 px-3">
                  <label class="form-check mb-0">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      v-model="meta.meta_key"
                    />
                    <span class="form-check-label text-dark">Hỗ trợ</span>
                  </label>

                </div>
                <div class="col-md-7 col-xl-9 col-6">
                  <input
                    type="text"
                    class="form-control"
                    v-model="meta.meta_value"
                    placeholder="Nội dung gói ..."
                  />
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">

        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Giá gốc</label>
              <input
                class="form-control"
                type="text"
                min="0"
                max="1000000000"
                v-model="displayPriceBase"
                @blur="isInputActiveBase = false"
                @focus="isInputActiveBase = true"
              />
              <div
                class="alert alert-danger"
                v-if="errors && errors.price_base"
              >
                {{ errors.price_base[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Giá khuyến mãi</label>
              <input
                class="form-control"
                type="text"
                min="0"
                max="1000000000"
                v-model="displayPriceSale"
                @blur="isInputActiveSale = false"
                @focus="isInputActiveSale = true"
              />
              <div
                class="alert alert-danger"
                v-if="errors && errors.price_sale"
              >
                {{ errors.price_sale[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Thời gian sử dụng</label>
              <select class="form-select" v-model="itemService.use_time">
                <option
                  v-for="(m, index) in months"
                  :key="index"
                  :value="index + 1"
                >
                  {{ m }} Tháng
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <button class="btn btn-primary me-2" @click="submitUpdate()">Cập nhật</button>
            <nuxt-link to="/admin/service" class="btn btn-primary">Quay lại</nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    itemService: {},
    status: ['pending', 'wait', 'active', 'unactive', 'suspended'],
    attribute: {
      support: false,
      name: '',
    },
    months: 36,
    errors:{},
    isInputActiveBase: false,
    isInputActiveSale: false,
  }),

  computed: {
    ...mapState('service', ['item']),
    displayPriceBase: {
      get: function () {
        if (this.isInputActiveBase) {
          return parseInt(this.itemService.price_base).toString()
        } else {
          return parseInt(this.itemService.price_base)
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, '$1,')
        }
      },
      set: function (modifiedValue) {
        let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ''))

        if (isNaN(newValue)) {
          newValue = 0
        }

        this.itemService.price_base = newValue
      },
    },
    displayPriceSale: {
     get: function () {
        if (this.isInputActiveSale) {
          return parseInt(this.itemService.price_sale).toString()
        } else {
          return parseInt(this.itemService.price_sale)
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, '$1,')
        }
      },
      set: function (modifiedValue) {
        let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ''))

        if (isNaN(newValue)) {
          newValue = 0
        }

        this.itemService.price_sale = newValue
      },
    },
  },

  async fetch({ store, query }){
    const serviceId = query.id
    await store.dispatch('service/getServiceId', serviceId) || {}
  },

  async created() {
    this.itemService = await this.item
  },


  methods: {
     async submitUpdate() {
       try {
         await this.$store.dispatch('service/updateService',this.itemService)
          await this.$router.push({ path: '/admin/service' })
          this.$toast.success('Cập nhật thành công !')
       }  catch (error) {
          this.$toast.error('Có lỗi xảy ra !')
        this.errors = this.$mixError(error)
      }

    },

    pushAttribute: function () {
      if (this.attribute.name === '') {
        alert('Nội dung trống không thể tạo thuộc tính')
        return
      }
      // push meta
      this.itemService.service_meta.push({
        meta_key: this.attribute.support, meta_value: this.attribute.name
      })
      // clear
      this.attribute = {
        support: false,
        name: '',
      }
    },

    remoteAttribute: function (index) {
      this.itemService.service_meta.splice(index, 1)
    },
  },
}
</script>

<style lang="scss" scoped>
.flatpickr-input {
  display: block;
  width: 100%;
  padding: 0.4375rem 0.75rem;
  font-size: 0.875rem;
  font-weight: 400;
  line-height: 1.4285714286;
  color: inherit;
  background-color: #ffffff;
  background-clip: padding-box;
  border: 1px solid #d9dbde;
  appearance: none;
  border-radius: 4px;
}
.ti-calendar{
  right: 1%;
  bottom: 12%;
  font-size: 20px;
  pointer-events: none;
}
.alert{
  box-shadow: none !important;
  color: #fb5858;
}
.alert-danger {
  padding: 0;
  border: 0;
  margin-top: 5px;
}
.error{
  background: #351e53 !important;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
