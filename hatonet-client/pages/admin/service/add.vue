<template>
  <section>
    <div class="row">
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label"
                >Tên gói <span class="red">*</span></label
              >
              <input
                type="text"
                class="form-control"
                placeholder="Tên gói ...."
                v-model="item.title"
                maxlength="50"
              />
              <div class="alert alert-danger" v-if="errors && errors.title">
                {{ errors.title[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Mô tả <span class="red">*</span></label>
              <input
                type="text"
                class="form-control"
                placeholder="Mô tả ...."
                v-model="item.description"
                maxlength="150"
              />
              <div
                class="alert alert-danger"
                v-if="errors && errors.description"
              >
                {{ errors.description[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label"
                >Trạng thái <span class="red">*</span></label
              >
              <select v-model="item.status" class="form-select">
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

            <div>
              <label class="form-check">
                <input class="form-check-input" type="checkbox" checked="" />
                <span class="form-check-label">Gói khuyên dùng</span>
              </label>
            </div>

            <div class="position-relative mb-3">
              <label class="form-label"
                >Ngày bắt đầu <span class="red">*</span></label
              >
              <flat-pickr
                v-model="item.service_start"
                :config="{ dateFormat: 'd-m-Y', minDate: 'today' }"
                placeholder="DD/MM/YYY"
              />
              <i class="ti ti-calendar position-absolute"></i>
            </div>
            <div
              class="alert alert-danger mt-negative-10"
              v-if="errors && errors.service_start"
            >
              {{ errors.service_start[0] }}
            </div>

            <div class="position-relative">
              <label class="form-label"
                >Ngày kết thúc <span class="red">*</span></label
              >
              <flat-pickr
                v-model="item.service_end"
                :config="{ dateFormat: 'd-m-Y', minDate: 'today' }"
                placeholder="DD/MM/YYY"
              />
              <i class="ti ti-calendar position-absolute"></i>
            </div>
            <div
              class="alert alert-danger mb-3"
              v-if="errors && errors.service_end"
            >
              {{ errors.service_end[0] }}
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div
              class="row align-items-center mb-3 bg-light text-dark rounded-2 py-2"
            >
              <div class="col-2 col-xl-1">
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

            <section v-for="(attr, i) in item.meta" :key="i">
              <div class="row align-items-center mb-1">
                <div class="col-2 col-xl-1">
                  <button class="btn" @click="remoteAttribute(i)">
                    <i class="ti ti-trash"></i>
                  </button>
                </div>
                <div class="col-md-3 col-xl-2 col-4 px-3">
                  <label class="form-check mb-0">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      v-model="item.meta[i].support"
                    />
                    <span class="form-check-label text-dark">Hỗ trợ</span>
                  </label>
                </div>
                <div class="col-md-7 col-xl-9 col-6">
                  <input
                    type="text"
                    class="form-control"
                    v-model="item.meta[i].name"
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
              <label class="form-label price-origin"
                >Giá gốc <span class="red">* </span>
                <input
                  class="form-control"
                  type="text"
                  min="0.00"
                  max="1000000000.00"
                  step="0.001"
                  v-model="displayPriceBase"
                  @blur="isInputActiveBase = false"
                  @focus="isInputActiveBase = true"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                />
              </label>
              <div
                class="alert alert-danger"
                v-if="errors && errors.price_base"
              >
                {{ errors.price_base[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label price-origin"
                >Giá khuyến mãi <span class="red">* </span>
                <input
                  class="form-control"
                  type="text"
                  min="0.00"
                  max="1000000000.00"
                  step="0.001"
                  v-model="displayPriceSale"
                  @blur="isInputActiveSale = false"
                  @focus="isInputActiveSale = true"
                />
              </label>
              <div
                class="alert alert-danger"
                v-if="errors && errors.price_sale"
              >
                {{ errors.price_sale[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Thời gian sử dụng <span class="red">*</span></label>
              <select v-model="item.use_time" class="form-select">
                <option v-for="(m, index) in mounth" :key="index" :value="m">
                  {{ m }} Tháng
                </option>
              </select>
              <div
                class="alert alert-danger"
                v-if="errors && errors.use_time"
              >
                {{ errors.use_time[0] }}
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <button class="btn btn-primary me-2" @click="add">Tạo gói</button>
            <nuxt-link to="/admin/service" class="btn btn-primary"
              >Quay lại</nuxt-link
            >
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    item: {
      price_sale: 0,
      price_base: 0,
      meta: [],
    },
    dataUser: {},
    status: ['pending', 'wait', 'active', 'unactive', 'suspended'],
    attribute: {
      support: false,
      name: '',
    },
    mounth: 36,
    errors: {},
    isInputActiveBase: false,
    isInputActiveSale: false,
  }),

  computed: {
    displayPriceBase: {
      get: function () {
        if (this.isInputActiveBase) {
          return this.item.price_base.toString()
        } else {
          return this.item.price_base
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, '$1,')
        }
      },
      set: function (modifiedValue) {
        let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ''))

        if (isNaN(newValue)) {
          newValue = 0
        }

        this.item.price_base = newValue
      },
    },
    displayPriceSale: {
      get: function () {
        if (this.isInputActiveSale) {
          return this.item.price_sale.toString()
        } else {
          return this.item.price_sale
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, '$1,')
        }
      },
      set: function (modifiedValue) {
        let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ''))

        if (isNaN(newValue)) {
          newValue = 0
        }

        this.item.price_sale = newValue
      },
    },
  },

  created() {
    this.dataUser = this.$cookies.get('_user')
  },

  methods: {
    pushAttribute: function () {
      if (this.attribute.name === '') {
        alert('Nội dung trống không thể tạo thuộc tính')
        return
      }
      // push meta
      this.item.meta.push(this.attribute)
      // clear
      this.attribute = {
        support: false,
        name: '',
      }
    },

    remoteAttribute: function (index) {
      this.item.meta.splice(index, 1)
    },

    async add() {
      const newData = {
        ...this.item,
        meta: this.item.meta.map((val) => {
          return {
            meta_key: val.support,
            meta_value: val.name,
          }
        }),
      }
      try {
        // Use dispatch to call an action
        await this.$store.dispatch('service/createService', newData)
        await this.$router.push({ path: '/admin/service' })
        this.$toast.success('Tạo dịch vụ thành công !')
      } catch (error) {
        this.$toast.error('Tạo dịch vụ thất bại !')
        this.errors = this.$mixError(error)
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.alert {
  box-shadow: none !important;
  color: #fb5858;
}
.alert-danger {
  padding: 0;
  border: 0;
  margin-top: 5px;
}
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
.ti-calendar {
  right: 1%;
  bottom: 15%;
  font-size: 20px;
  pointer-events: none;
}
.red {
  color: crimson;
}
.mt-negative-10 {
  margin-top: -10px;
}
.price-origin div {
  margin-left: 13px;
  color: #14c431;
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
//responsive
//mobile
@media screen and (max-width: 767px) {
}
</style>
